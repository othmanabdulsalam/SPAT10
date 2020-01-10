<?php
/*
 * created by Michael Jarratt
 *
 * this class is responsible for providing a simple API to retrieve information needed
 * to create the report from the database
 */

require_once __DIR__."/AuditQuery.php";
require_once __DIR__."/UserQuery.php";
require_once __DIR__."/QuestionQuery.php";

class ReportInfoGetter
{
    private $auditQuery;
    private $userQuery;
    private $questionQuery;

    public function __construct()
    {
        $this->auditQuery = new AuditQuery();
        $this->userQuery = new UserQuery();
        $this->questionQuery = new QuestionQuery();
    }

    /*
     *
     */
    public function getAudit($clientID, $auditID)
    {
        $reportInfo = []; //array in which information will be gathered to be passed out
        $reportInfo['audit'] = $this->auditQuery->getAudit($clientID); //location, date scored
        $reportInfo['user'] = $this->userQuery->getClientUsername($clientID); //name of client
        $reportInfo['questions'] = $this->QuestionQuery->getAuditQUestions($auditID);
    }
}