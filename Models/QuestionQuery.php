<?php
/*
 * Created by Michael Jarratt
 *
 * this class serves the purpose of storing queries related to questions
 */

require_once __DIR__."/Database.php";

class QuestionQuery
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    /*
     * gets all questions that are part of audit
     */
    public function getAuditQuestions($auditID)
    {
        return $this->database->retrieve("SELECT * FROM Questions WHERE questionID IN (SELECT questionID FROM AuditQuestions WHERE auditID = \"$auditID\")");
    }

    /**
     * returns array of questions within subcategory that are included in audit
     *
     * @param String $auditID audit being fetched for
     * @param String $subCatID subcategory of questions
     * @return array
     */
    public function getSubCatAuditQuestions($auditID, $subCatID)
    {
        return $this->database->retrieve("SELECT questionID,questionContent FROM Questions WHERE subCatID = \"$subCatID\" AND questionID IN (SELECT questionID FROM AuditQuestions WHERE auditID = \"$auditID\")");
    }

    /**
     * returns array of questions with their scoring guidelines within subcategory that
     * are included in audit
     *
     * @param $auditID
     * @param $subCatID
     * @return array
     */
    public function getSubCatAuditQuestionsWithGuidelines($auditID,$subCatID)
    {
        return $this->database->retrieve("SELECT questionID, questionContent, oneMark, twoMark, threeMark, fourMark, fiveMark  FROM Questions WHERE subCatID = \"$subCatID\" AND questionID IN (SELECT questionID FROM AuditQuestions WHERE auditID = \"$auditID\")");
    }

    /**
     * returns array containing ID's of all questions in an audit
     *
     * @param String $auditID  ID(s) of the aduit to fetch Questions IDs for
     *
     * @return array containing ID of audits questions
     */
    public function getQuestionIDs($auditID)
    {
        $raw = $this->database->retrieve("SELECT questionID FROM Questions WHERE questionID IN (SELECT questionID FROM AuditQuestions WHERE auditID = \"$auditID\")");
        $idArray = []; //array that will store ID's
        foreach ($raw as $tuple) //loop to extract ID's
        {
            array_push($idArray, $tuple['questionID']); //adds ID from tuple to array
        }
        return $idArray;
    }



    /**
     * returns all questions which are children of subCategory in the form of an array
     *
     * (array) questions
     *  [0.X]
     *      (array) questions
     *          'questionID'    => (String)
     *          'questionContent'       => (String) -content of the question
     *
     * @param String $subcatID
     * @return array of question tuples
     */
    public function getAllQuestions($subcatID)
    {
        return $this->database->retrieve("SELECT questionID, questionContent FROM Questions WHERE subCatID = \"$subcatID\"");
    }

    /**
     * Creates an entry in AuditQuestion linking the audit with the question supplied
     *
     * @param String $auditID
     * @param String $questionID
     */
    public function submitQuestionToAudit($auditID,$questionID)
    {
        $this->database->update("INSERT INTO AuditQuestions VALUES(\"$auditID\",\"$questionID\")");
    }

    /**
     * creates a new question
     *
     * @param String $questionContent
     * @param int $subCatID
     * @param String $oneMark
     * @param String $twoMark
     * @param String $threeMark
     * @param String $fourMark
     * @param String $fiveMark
     */
    public function createNewQuestion($questionContent,$subCatID,$oneMark,$twoMark,$threeMark,$fourMark,$fiveMark)
    {
        $this->database->update("INSERT INTO Questions (questionContent,subCatID,oneMark,twoMark,threeMark,fourMark,fiveMark) VALUES (\"$questionContent\",\"$subCatID\",\"$oneMark\",\"$twoMark\",\"$threeMark\",\"$fourMark\",\"$fiveMark\")");
    }
}