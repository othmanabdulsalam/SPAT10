<?php
/*
 * created by Michael Jarratt
 * this class is responsible for providing a simple API to retrieve information needed
 * to Score questions
 */

require_once __DIR__."/AuditQuery.php";
require_once __DIR__."/UserQuery.php";
require_once __DIR__."/QuestionQuery.php";
require_once __DIR__."/SubCatQuery.php";
require_once __DIR__."/CategoryQuery.php";
require_once __DIR__."/AnswerQuery.php";
require_once __DIR__."/ScoreQuery.php";
require_once __DIR__."/EvidenceQuery.php";
require_once __DIR__."/FlagQuery.php";

class ScoringInfoGetter
{
    private $auditQuery;
    private $userQuery;
    private $questionQuery;
    private $subCatQuery;
    private $categoryQuery;
    private $answerQuery;
    private $scoreQuery;
    private $evidenceQuery;
    private $flagQuery;

    public function __construct()
    {
        $this->auditQuery = new AuditQuery();
        $this->userQuery = new UserQuery();
        $this->questionQuery = new QuestionQuery();
        $this->subCatQuery = new SubCatQuery();
        $this->categoryQuery = new CategoryQuery();
        $this->answerQuery = new AnswerQuery();
        $this->scoreQuery = new ScoreQuery();
        $this->evidenceQuery = new EvidenceQuery();
        $this->flagQuery = new FlagQuery();
    }


    /**
     * gets all information needed to display to the scorer, formatted as:
     *
     * (array) scoringInfo
     *      'audit'         => (array) audit
     *                          'location'      => (String)
     *                          'dateCreated'    => (DATETIME)
     *
     *      'client'        => (array) client
     *                          'username'      => (String)
     *
     *      'scoringContent' => (array) Categories
     *                          [0..X]
     *                           'catID'             => (String)
     *                           'catCode'           => (String)
     *                           'catDescription'    => (String)
     *                           'subCategories'     => (array) subCategory
     *                                                       [0..X]
     *                                                           'subCatID'          =>  (String)
     *                                                           'subCatCode'        =>  (String)
     *                                                           'subCatDescription' =>  (String)
     *                                                           'questions'         =>  (array) questions
     *                                                                                          [0..X]
     *                                                                                            'questionID'        => (String)
     *                                                                                            'questionContent'   => (String)
     *                                                                                            'legalFlag'         => (String/null)
     *                                                                                            'answer'            => (array) answer
     *                                                                                                                          'content' => (String)
     *                                                                                                                          'comment' => (String/null)
     *                                                                                                                          'evidence' => (array)
     *                                                                                                                                          [0..X]
     *                                                                                                                                              'type' => (String) -e.g "Image", "Video"
     *                                                                                                                                              'path' => (string) - path to file on server
     *
     * @param String $auditID audit to fetch information for
     * @return array
     */
    public function getScoringInfo($auditID)
    {
        $scoringInfo = []; //array in which information will be stored to pass on
        $clientID = $this->auditQuery->getClientID($auditID);
        $scoringInfo['audit'] = $this->auditQuery->getUnscoredAudit($auditID);
        $scoringInfo['client'] = $this->userQuery->getUsername($clientID);
        $scoringInfo['scoringContent'] = $this->getScoringContent($auditID);

        return $scoringInfo;
    }

    /**
     * this function gets data and and creates the datastructure containing
     * all information about the audit that needs to be passed out
     *
     * @param $auditID
     * @return array
     */
    private function getScoringContent($auditID)
    {
        //gets Question IDs
        $questionIDs = $this->questionQuery->getQuestionIDs($auditID);
        //gets SubCategory IDs
        $subCatIDs = $this->subCatQuery->getSubCatID(join(",",$questionIDs)); //join turns array to comma separated string -> "1,2,3"...
        //gets Category IDs
        $categoryIDs = $this->categoryQuery->getCategoryIDs(join(",",$subCatIDs));


        $categories = $this->categoryQuery->getCategories(join(",",$categoryIDs)); //root of datastructure

        foreach($categories as &$category) //passing category by reference so it can be changes
        {
            $category['subCategories'] = $this->subCatQuery->getSubCategories($category['catID'],join(",",$subCatIDs)); //puts array of subcategories into category
            foreach($category['subCategories'] as &$subCategory) //for each subCategory
            {
                $subCategory['questions'] = $this->questionQuery->getSubCatAuditQuestionsWithGuidelines($auditID,$subCategory['subCatID']); //gets questions from subCat that appear in query and put them in questions array
                foreach($subCategory['questions'] as &$question) //for each question
                {
                    $question['answer'] = $this->answerQuery->getAnswer($auditID,$question['questionID']); //gets answer for question
                    $question['answer']['comment'] = $this->answerQuery->getComment($auditID,$question['questionID']); //gets comment for answer (null if no comment)
                    $question['answer']['evidence'] = $this->evidenceQuery->getEvidence($auditID,$question['questionID']); //gets array of tuples from evidence table or null
                    $question['legalFlag'] = $this->flagQuery->getQuestionFlag($auditID,$question['questionID']); //gets flag for question or null
                }
            }
        }
        return $categories; //return root of datastructure
    }
}