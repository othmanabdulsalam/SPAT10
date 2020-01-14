<?php
/*
 * Created by Michael Jarratt
 *
 * this class serves the purpose of storing queries related to Evidence
 */

require_once __DIR__."/Database.php";

class EvidenceQuery
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    /**
     * returns array of tuples (type,path) from evidence table.
     * returns null if evidence not present for question in audit.
     *
     * @param String $auditID audit question belongs to
     * @param String $questionID
     * @return array|null
     */
    public function getEvidence($auditID,$questionID)
    {
        $raw = $this->database->retrieve("SELECT type, path FROM Evidence WHERE auditID = \"$auditID\" AND questionID = \"$questionID\"");
        if(isset($raw[0]))
        {
           return $raw; //returns array of tuples
        }
        else
        {
            return null;
        }

    }
}