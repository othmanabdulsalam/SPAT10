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
        return $this->database->retrieve("SELECT Audit.auditID, location, dateCreated, dateScored FROM Audit, ScoredAudits
                                                 WHERE clientID = 4 AND Audit.auditID = ScoredAudits.auditID ORDER BY dateCreated;");
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
     * returns single tuple of audit which has not been completed
     *
     * @param String $auditID
     * @return array
     */
    public function getInProgressAudit($auditID)
    {
        return $this->database->retrieve("SELECT auditID, clientID, location, dateCreated FROM Audit WHERE completed = false AND auditID = \"$auditID\"")[0];
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

    /**
     * Returns array of audits WHERE completed = false
     *
     * (array) audits
     *  [0..X]
     *      'auditID'       => (String)
     *      'location'      => (String)
     *      'dateCreated'   => (DATETIME)
     *
     * @return array of incomplete audits
     */
    public function getIncompleteAudits()
    {
        return $this->database->retrieve("SELECT auditID,location,dateCreated FROM Audit WHERE completed = false");
    }

    /**
     * sets completed field to true for audit
     *
     * @param $auditID
     */
    public function flagAsComplete($auditID)
    {
        $this->database->update("UPDATE Audit SET completed = true WHERE auditID = \"$auditID\"");
    }
}