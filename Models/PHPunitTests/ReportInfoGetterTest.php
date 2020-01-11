<?php
/*
 * created by Michael Jarratt
 *
 * this tests ReportInfoGetter, the class responsible for fetching and packaging
 * all information needed to generate a report
 */

use PHPUnit\Framework\TestCase;

require_once __DIR__."/../Database.php";
require_once __DIR__."/../AuditQuery.php";
require_once __DIR__."/../UserQuery.php";
require_once __DIR__."/../QuestionQuery.php";
require_once __DIR__."/../ReportInfoGetter.php";

class ReportInfoGetterTest extends TestCase
{


    public function testGetAudit()
    {
        $reportInfoGetter = new ReportInfoGetter();
        $reportInfo = $reportInfoGetter->getAudit(4,1);
        //var_dump($reportInfo);
        $this->assertTrue($reportInfo['audit']['location'] == "bigg Stiggs oil rigg");
        $this->assertTrue($reportInfo['user']['username'] == "client");
        $this->assertTrue($reportInfo['questions'][0]['questionID'] == 1);
    }

    public function testGetContent()
    {
        $reportInfoGetter = new ReportInfoGetter();
        $reflection = new \ReflectionClass(get_class($reportInfoGetter));
        $getContent = $reflection->getMethod("getContent");
        $getContent->setAccessible(true);

        $content = $getContent->invokeArgs($reportInfoGetter,array(1)); // 1 = auditID

        $this->assertTrue($content == 1);
    }
}
