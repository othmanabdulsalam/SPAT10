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

class AuditCreationQuery
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
    public function getAllQuestionsAndCategories()
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
}