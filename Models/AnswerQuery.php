<?php
/*
 * Created by Michael Jarratt
 *
 * this class serves the purpose of storing queries related to Answers
 */

require_once __DIR__."/Database.php";

class AnswerQuery
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    /**
     * returns answer content that belongs to audits instance of question
     *
     * @param String $auditID audit the question belongs to
     * @param String $questionID question the answer belongs to
     * @return array
     */
    public function getAnswer($auditID,$questionID)
    {
        return $this->database->retrieve("SELECT content FROM Answers WHERE auditID = \"$auditID\" AND questionID = \"$questionID\"")[0];
    }

    /**
     * Gets comment associated with answer, null if no comment
     *
     * @param $auditID
     * @param $questionID
     * @return mixed|null
     */
    public function getComment($auditID,$questionID)
    {
        $tupleArray = $this->database->retrieve("SELECT comment FROM AnswerComments WHERE questionID = \"$questionID\" AND  auditID = \"$auditID\"");
        if(isset($tupleArray[0])) //if this answer had a comment
        {
            return $tupleArray[0]['comment']; //returns comment String
        }
        else
        {
            return null;
        }
    }
}