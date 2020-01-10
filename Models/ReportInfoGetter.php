<?php
/*
 * created by Michael Jarratt
 *
 * this class is responsible for providing a simple API to retrieve information needed
 * to create the report from the database
 */

require_once __DIR__."/AuditQuery.php";
require_once __DIR__."/UserQuery.php";

class ReportInfoGetter
{
    private $auditQuery;
    private $userQuery;

    public function __construct()
    {
        $this->auditQuery = new AuditQuery();
        $this->userQuery = new UserQuery();
    }

    /*
     *
     */
    public function getAudit($clientID, $auditID)
    {
        $reportInfo = []; //array in which information will be gathered to be passed out
        $reportInfo['audit'] = $this->auditQuery->getAudit($clientID);
        $reportInfo['user'] = $this->userQuery->getClientUsername($clientID);
    }
}