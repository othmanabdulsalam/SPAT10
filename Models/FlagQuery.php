<?php
/*
 * Created by Michael Jarratt
 *
 * this class serves the purpose of storing queries related to Legal Flags
 */

require_once __DIR__."/Database.php";

class FlagQuery
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
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
        $resultTuple = $this->database->retrieve("SELECT description FROM LegalFlags WHERE flagID = (SELECT flagID FROM QuestionFlags WHERE auditID = \"$auditID\" AND questionID = \"$questionID\")");
        if(isset($resultTuple[0])) //if a flag exists
        {
            return $resultTuple[0]['description']; //return string
        }
        else
        {
            return null;
        }
    }

    /**
     * Returns all legal flags: flagID and flagContent
     *
     * @return array of flags
     */
    public function getAllFlags()
    {
        return $this->database->retrieve("SELECT * FROM LegalFlags");
    }

    /**
     * Takes info and creates an entry in the QuestionFlags link table
     *
     * @param $auditID
     * @param $questionID
     * @param $flagID
     */
    public function linkFlag($auditID,$questionID,$flagID)
    {
        $this->database->update("INSERT INTO QuestionFlags VALUES (\"$auditID\",\"$questionID\",\"$flagID\")");
    }
}