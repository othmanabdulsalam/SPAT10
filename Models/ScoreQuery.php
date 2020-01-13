<?php
/*
 * Created by Michael Jarratt
 *
 * this class serves the purpose of storing queries related to Scores
 */

require_once __DIR__."/Database.php";

class ScoreQuery
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    /**
     * returns the score and comment for respective question in audit
     *
     * @param String $auditID audit the question belongs to
     * @param String $questionID question the score belongs to
     * @return mixed
     */
    public function getScore($auditID,$questionID)
    {
        return $this->database->retrieve("SELECT score,comment FROM Scores WHERE auditID = \"$auditID\" AND questionID = \"$questionID\"")[0];
    }
}