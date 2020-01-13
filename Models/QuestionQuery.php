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
     * returns description of question flag, null if there isn't one
     *
     * @param $auditID
     * @param $questionID
     * @return mixed|null
     */
    public function getQuestionFlag($auditID,$questionID)
    {
        $resultTuple = $this->database->retrieve("SELECT description FROM QuestionFlag WHERE auditID = \"$auditID\" AND questionID = \"$questionID\"");
        if(isset($resultTuple[0])) //if a flag exists
        {
            return $resultTuple[0]['description']; //return string
        }
        else
        {
            return null;
        }
    }
}