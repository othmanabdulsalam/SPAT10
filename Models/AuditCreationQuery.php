<?php
/*
 * created by Michael Jarratt and Calvin Blackman
 *
 * This class is responsible for handling more generalised query classes
 * and providing a simple api for the creation of audits by the admin.
 */

require_once __DIR__."/AuditQuery.php";
require_once __DIR__."/CategoryQuery.php";
require_once __DIR__."/SubCatQuery.php";
require_once __DIR__."/AnswerQuery.php";
require_once __DIR__."/EvidenceQuery.php";
require_once __DIR__."/QuestionQuery.php";
require_once __DIR__."/UserQuery.php";
require_once __DIR__."/FlagQuery.php";

class AuditCreationQuery
{
    private $auditQuery;
    private $categoryQuery;
    private $subCatQuery;
    private $answerQuery;
    private $evidenceQuery;
    private $questionQuery;
    private $userQuery;
    private $flagQuery;

    public function __construct()
    {
        $this->auditQuery = new AuditQuery();
        $this->categoryQuery = new CategoryQuery();
        $this->subCatQuery = new SubCatQuery();
        $this->answerQuery = new AnswerQuery();
        $this->evidenceQuery = new EvidenceQuery();
        $this->questionQuery = new QuestionQuery();
        $this->userQuery = new UserQuery();
        $this->flagQuery = new FlagQuery();
    }


    /**
     * This method provides an API to get all information needed for an admin to
     * create an audit, it is returned in the following format:
     *
     * (array) auditCreationInfo
     *  'clients'
     *     [0..X]
     *         'userID'    =>   (String)
     *         'username'  =>   (String)
     *  'questionsAndCategories' => (array) Categories
     *                                  [0..X]
     *                                      'catID'             =>  (String)
     *                                      'catCode'           =>  (String)
     *                                      'catDescription'    =>  (String)
     *                                      'subCategories'     =>  (array) subCategories
     *                                                                  [0..X]
     *                                                                      'subCatID'          =>  (String)
     *                                                                      'subCatCode'        =>  (String)
     *                                                                      'subCatDescription' =>  (String)
     *                                                                      'questions'         =>  (array) questions
     *                                                                                                  [0..X]
     *                                                                                                      'questionID'       =>  (String)
     *                                                                                                      'questionContent'  =>  (String)
     * 'legalFLags' => (array) legalFlags
     *                  [0..X]
     *                      'flagID'    => (String)
     *                      'Content'   => (String)
     */
    public function getAllAuditCreationInfo()
    {
        $auditCreationinfo = [];
        $auditCreationinfo['clients'] = $this->userQuery->getAllClients(); //gets every client, which the admin can select
        $auditCreationinfo['questionsAndCategories'] = $this->getAllQuestionsAndCategories(); //gets datastructure of all categories, subCategories and questions
        $auditCreationinfo['legalFLags'] = $this->flagQuery->getAllFlags(); //gets all flags
    }


    /**
     * returns all categories, their subCategories and their questions, in the following format:
     *
     * (array) categories
     *  [0..X]
     *      'catID'             =>  (String)
     *      'catCode'           =>  (String)
     *      'catDescription'    =>  (String)
     *      'subCategories'     =>  (array) subCategories
     *                                  [0..X]
     *                                      'subCatID'          =>  (String)
     *                                      'subCatCode'        =>  (String)
     *                                      'subCatDescription' =>  (String)
     *                                      'questions'         =>  (array) questions
     *                                                                  [0..X]
     *                                                                      'questionID'       =>  (String)
     *                                                                      'questionContent'  =>  (String)
     *
     * @return array
     */
    private function getAllQuestionsAndCategories()
    {
        $categories = $this->categoryQuery->getAllCategories(); //gets all categories
        foreach($categories as &$category) //passing by reference
        {
            $category['subCategories'] = $this->subCatQuery->getAllSubcategories($category['catID']); //gets every subcategory for each category
            foreach($category['subCategories'] as &$subCategory)
            {
                $subCategory['questions'] = $this->questionQuery->getAllQuestions($subCategory['subCatID']); //gets every question for each subCategory
            }
        }
        return $categories;
    }


    /**
     * Creates audit and populates AuditQuestion with questionIDs and questionFlagIDs
     * in the following format:
     *
     * (array) questionIDs
     *  [0..X]
     *      'questionID'    =>  (String)
     *
     * (array) questionFlags -empty array if no flags are assigned
     *  [0..X]
     *      'questionID'    => (String)
     *      'flagID'        => (String)
     *
     *  @param String $clientID     client that owns audit
     *  @param String $location     audit location
     *  @param array $questionIDs   array of IDs of questions selected for audit
     */
    public function submitAudit($clientID,$location,$questionIDs,$questionFLags)
    {
        $auditID = $this->auditQuery->submitAudit($clientID,$location); //creates audit in DB and gets auditID
        //iterate through questionIDs and use auditID to create populate AuditQuestions
        foreach($questionIDs as $questionID) //links questions
        {

            $this->questionQuery->submitQuestionToAudit($auditID,$questionID);
        }
        foreach($questionFLags as $questionFlag) //links flags
        {
            $this->flagQuery->linkFlag($auditID,$questionFlag['questionID'],$questionFlag['flagID']);
        }
    }
}