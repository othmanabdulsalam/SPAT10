<?php
/*
 * created by Michael Jarratt and Calvin Blackman
 *
 * This class is responsible for handling more generalised query classes
 * and providing a simple api for the Questioner controller.
 */

require_once __DIR__."/AuditQuery.php";
require_once __DIR__."/CategoryQuery.php";
require_once __DIR__."/SubCatQuery.php";
require_once __DIR__."/AnswerQuery.php";
require_once __DIR__."/EvidenceQuery.php";
require_once __DIR__."/QuestionQuery.php";
require_once __DIR__."/UserQuery.php";

class QuestionerQuery
{
    private $auditQuery;
    private $categoryQuery;
    private $subCatQuery;
    private $answerQuery;
    private $evidenceQuery;
    private $questionQuery;
    private $userQuery;

    public function __construct()
    {
        $this->auditQuery = new AuditQuery();
        $this->categoryQuery = new CategoryQuery();
        $this->subCatQuery = new SubCatQuery();
        $this->answerQuery = new AnswerQuery();
        $this->evidenceQuery = new EvidenceQuery();
        $this->questionQuery = new QuestionQuery();
        $this->userQuery = new UserQuery();
    }


    /**
     * puts submitted comments and answers in database, submit as formatted below:
     *
     * (array) answers
     *  [0..X]
     *      (array) answer
     *          'questionID'    => (String)
     *          'content'       => (String) -content of the answer
     *          'comment'       => (String/null) -comment for the answer, or null if no comment
     *
     * @param String $auditID audit these answers are for
     * @param array $answers array of answers (arrays themselves)
     */
    public function submitAnswers($auditID,$answers)
    {
        foreach($answers as $answer)
        {
            $this->answerQuery->submitAnswer($auditID,$answer['questionID'],$answer['content']); //create entry in Answers
            if(isset($answer['comment'])) //if the answer has a comment
            {
                $this->answerQuery->submitComment($auditID,$answer['questionID'],$answer['comment']); //create entry in AnswerComments
            }
        }
        $this->auditQuery->flagAsComplete($auditID); //sets complete to true for audit in audit table
    }

    /**
     * returns all information that needs to be displayed for questioning
     * in an easily accessible format.
     *
     * format:
     *
     * (array) questionerInfo
     *  'audit'     =>  (array) audit
     *                      'auditID'       =>  (String)
     *                      'clientID'      =>  (String)
     *                      'location'      =>  (String)
     *                      'dateCreated'   =>  (DATETIME)
     *  'client'    =>  (array) client
     *                      'username'      => (String)
     *  'questions'         => (array) categories
     *      [0..X]
     *          'catID'             => (String)
     *          'catCode'           => (String)
     *          'catDescription'    => (String)
     *          'subCategories'     => (array) subCategories
     *                                      'subcatID'          => (String)
     *                                      'subCatCode'        => (String)
     *                                      'subCatDescription" => (String)
     *                                      'questions'         => (array) questions
     *                                                              [0..X]
     *                                                                  'questionID' => (String)
     *                                                                  'questionContent' => (String)
     *                                                                  'legalFlag' => (String/null) - null if there is no flag
     *
     *
     * @param String $auditID audit to get questioning info for
     * @return array
     */
    public function getQuestionerInfo($auditID)
    {
        $questionerInfo = [];
        $questionerInfo['audit'] = $this->auditQuery->getInProgressAudit($auditID);
        $questionerInfo['client'] = $this->userQuery->getUsername($questionerInfo['audit']['clientID']); //gets clients name
        $questionerInfo['questions'] = $this->getQuestions($auditID);

        return $questionerInfo;
    }

    /**
     * returns questions of audit in following format:
     *
     * categories -> subCategories -> questions
     *
     * @param String $auditID audit to get questions for
     * @return array
     */
    private function getQuestions($auditID)
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
                $subCategory['questions'] = $this->questionQuery->getSubCatAuditQuestions($auditID,$subCategory['subCatID']); //gets questions from subCat that appear in query and put them in questions array
                foreach($subCategory['questions'] as &$question) //for each question
                {
                    $question['legalFlag'] = $this->questionQuery->getQuestionFlag($auditID,$question['questionID']); //gets flag for question or null
                }
            }
        }
        return $categories;
    }
}