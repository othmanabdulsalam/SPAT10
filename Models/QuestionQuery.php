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

    /*
     * returns array containing ID's of all questions in an audit
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
}