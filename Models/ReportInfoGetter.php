<?php
/*
 * created by Michael Jarratt
 *
 * this class is responsible for providing a simple API to retrieve information needed
 * to create the report from the database
 */

require_once __DIR__."/AuditQuery.php";
require_once __DIR__."/UserQuery.php";
require_once __DIR__."/QuestionQuery.php";
require_once __DIR__."/SubCatQuery.php";
require_once __DIR__."/CategoryQuery.php";
require_once __DIR__."/AnswerQuery.php";
require_once __DIR__."/ScoreQuery.php";


class ReportInfoGetter
{
    private $auditQuery;
    private $userQuery;
    private $questionQuery;
    private $subCatQuery;
    private $categoryQuery;
    private $answerQuery;
    private $scoreQuery;

    public function __construct()
    {
        $this->auditQuery = new AuditQuery();
        $this->userQuery = new UserQuery();
        $this->questionQuery = new QuestionQuery();
        $this->subCatQuery = new SubCatQuery();
        $this->categoryQuery = new CategoryQuery();
        $this->answerQuery = new AnswerQuery();
        $this->scoreQuery = new ScoreQuery();
    }

    /*
     * gets all information needed to create a report for specific audit
     * and returns it in an associatively index array
     */
    /**
     * gets all information needed to create a report and returns it in the following format:
     *
     * (array) reportInfo
     * 'audit'          => (array) audit
     *                      'location'      => (String)
     *                      'dateScored'    => (DATETIME)
     *
     * 'user'           => (array) user
     *                      'username'      =>(String)
     *
     * 'reportContent'  => (array) categories
     *                      [0..X]
     *                          'catID'             => (String)
     *                          'catCode'           => (String)
     *                          'catDescription'    => (String)
     *                          'subCategories'       => (array) subCategories
     *                                                      [0..X]
     *                                                          'subCatID'          =>  (String)
     *                                                          'subCatCode'        =>  (String)
     *                                                          'subCatDescription' =>  (String)
     *                                                          'questions'         =>  (array) questions
     *                                                                                      [0..X]
     *                                                                                          'questionID'        => (String)
     *                                                                                          'questionContent'   => (String)
     *                                                                                          'subCatID'          => (String)
     *                                                                                          'legalFlag'         => (String/null) 
     *                                                                                          'answer'            => (array) answer
     *                                                                                                                      'content' => (String)
     *                                                                                                                      'score'   => (array) score
     *                                                                                                                                      'score'     =>  (int)
     *                                                                                                                                      'comment'   =>  (String)
     * 
     * @param String $clientID ID of user who the audit belongs to
     * @param String $auditID ID of audit to get info for
     * @return array
     */
    public function getAudit($clientID, $auditID)
    {
        $reportInfo = []; //array in which information will be gathered to be passed out
        $reportInfo['audit'] = $this->auditQuery->getAudit($auditID); //location, date scored
        $reportInfo['user'] = $this->userQuery->getUsername($clientID); //name of client
        $reportInfo['reportContent'] = $this->getContent('auditID'); //gets cats, subCats, questions, answers and scores

        return $reportInfo;
    }

    /*
     * this function gets data and creates the datastructure containing all
     * information to be presented in the report
     */
    private function getContent($auditID)
    {
        //gets Question IDs
        $questionIDs = $this->questionQuery->getQuestionIDs($auditID);
        //gets SubCategory IDs
        $subCatIDs = $this->subCatQuery->getCatID(join(",",$questionIDs)); //join turns array to comma separated string -> "1,2,3"...
        //gets Category IDs
        $categoryIDs = $this->categoryQuery->getCategoryIDs(join(",",$subCatIDs));


        $categories = $this->categoryQuery->getCategories(join(",",$categoryIDs)); //root of datastructure

        foreach($categories as &$category) //passing category by reference so it can be changes
        {
            $category['subCategories'] = $this->subCatQuery->getSubCategories(join(",",$subCatIDs)); //puts array of subcategories into category
            foreach($category['subCategories'] as &$subCategory) //for each subCategory
            {
                $subCategory['questions'] = $this->questionQuery->getSubCatAuditQuestions($auditID,$subCategory['subCatID']); //gets questions from subCat that appear in query and put them in questions array
                foreach($subCategory['questions'] as &$question) //for each question
                {
                    $question['answer'] = $this->answerQuery->getAnswer($auditID,$question['questionID']); //gets answer for question
                    $question['answer']['score'] = $this->scoreQuery->getScore($auditID,$question['questionID']); //gets score tuple for answer
                    $question['legalFlag'] = $this->questionQuery->getQuestionFlag($auditID, $question['questionID']); //gets QuestionFlag if one exists
                }
            }
        }
        return $categories; //return root of datastructure
    }
}