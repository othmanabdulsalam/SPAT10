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

    /**
     * inserts supplied score into database
     *
     * @param String $auditID
     * @param String $questionID
     * @param int $score
     * @param String $comment
     */
    public function insertScore($auditID,$questionID,$score,$comment)
    {
        $this->database->update("INSERT INTO Scores (questionID, auditID, score, comment)  VALUE (\"$questionID\",\"$auditID\",\"$score\",\"$comment\")");
    }

    /**
     * inserts each supplied score into the Scores table.
     * creates entry in ScoredAudits table.
     *
     * @param string $auditID
     * @param $scoreArray
     */
    public function submitScores($auditID,$scoreArray)
    {
        foreach($scoreArray as $score) //for each score submitted
        {
            $this->insertScore($auditID,$score['questionID'],$score['score'],$score['comment']); //inserts score into database
        }

        $this->database->update("INSERT INTO ScoredAudits VALUES(\"$auditID\",NOW())");
    }
}