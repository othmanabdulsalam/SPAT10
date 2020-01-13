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
        return $this->database->retrieve("SELECT Audit.auditID, location, dateScored, dateCreated FROM Audit,ScoredAudits WHERE clientID = \"$clientID\" AND Audit.auditID NOT IN(SELECT auditID FROM ScoredAudits) ORDER BY dateCreated DESC");
    }

    /*
     * gets specific scored audit by ID
     */
    public function getScoredAudit($auditID)
    {
        return $this->database->retrieve("SELECT location, dateScored, dateCreated FROM Audit,ScoredAudits WHERE Audit.auditID = \"$auditID\"")[0]; //returns the single tuple from array
    }

    /**
     * gets specific unscored audit by ID
     *
     * @param $auditID
     * @return array
     */
    public function getUnscoredAudit($auditID)
    {
        return $this->database->retrieve("SELECT location, dateCreated FROM Audit WHERE auditID = \"$auditID\"");
    }

    /**
     * Gets the ID of the client who owns audit
     *
     * @param String $auditID the audit to get the Client of
     * @return mixed ID of audits Client
     */
    public function getClientID($auditID)
    {
        return $this->database->retrieve("SELECT clientID FROM Audit WHERE auditID = \"$auditID\"")[0]['clientID'];
    }

    /**
     * Gets all audits that have been completed but not yet scored
     *
     * @return array
     */
    public function getUnscoredAudits()
    {
        return $this->database->retrieve("SELECT auditID,location,dateCreated FROM Audit WHERE completed = true AND auditID NOT IN (SELECT auditID FROM ScoredAudits)");
    }
}