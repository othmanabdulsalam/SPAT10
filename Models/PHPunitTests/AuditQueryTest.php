<?php
/*
 * created by Michael Jarratt
 *
 * testing queries in the AuditQuery class
 */

use PHPUnit\Framework\TestCase;

require_once __DIR__."\..\Database.php"; //absolute path for PHP query
require_once __DIR__."\..\AuditQuery.php"; //absolute path for PHP query

class AuditQueryTest extends TestCase
{

    //tests method to get all audits that belongs to client
    public function testGetAudits()
    {
        $auditQuery = new AuditQuery();
        $clientAudits = $auditQuery->getAudits(1);
        //var_dump($clientAudits);
        $this->assertTrue($clientAudits[0]['auditID'] == 1);
        $this->assertTrue(!isset($clientAudits[1]));
    }

    //test method to get single audit by ID
    public function testGetAudit()
    {
        $auditQuery = new AuditQuery();
        $audit = $auditQuery->getScoredAudit(1);
        //var_dump($audit);
        $this->assertTrue($audit['location'] == "bigg Stiggs oil rigg");
    }

    public function testGetIncompleteAudits()
    {
        $auditQuery = new AuditQuery();
        $audits = $auditQuery->getIncompleteAudits();
        var_dump($audits);
        $this->assertTrue($audits[0]['auditID']==3);
    }
}
