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
}