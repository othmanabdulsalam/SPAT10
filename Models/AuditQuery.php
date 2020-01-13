<?php
/*
 * created by Michael Jarratt
 *
 * this class is responsible for executing queries related to audits and returning results (if applicable)
 */
require_once __DIR__."/Database.php";

class AuditQuery
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    /*
     * This method will return the ID, location and dateScored of all Audits belonging to client
     * Audits must be completed and be scored
     */
    public function getAudits($clientID)
    {
        return $this->database->retrieve("SELECT Audit.auditID, location, dateScored, dateCreated FROM Audit,ScoredAudits WHERE clientID = \"$clientID\" AND Audit.auditID NOT IN(SELECT auditID FROM ScoredAudits) ");
    }

    /*
     * gets specific audit by ID
     */
    public function getAudit($auditID)
    {
        return $this->database->retrieve("SELECT location, dateScored FROM Audit,ScoredAudits WHERE Audit.auditID = \"$auditID\"")[0]; //returns the single tuple from array
    }
}