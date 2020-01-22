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
        $reflection = new \ReflectionClass(get_class($reportInfoGetter));  //
        $getContent = $reflection->getMethod("getContent");         //  setup that allows private method to be called for testing
        $getContent->setAccessible(true);                        //

        //$content = array of content needed to generate the audit report
        $content = $getContent->invokeArgs($reportInfoGetter,array(1)); // 1 = auditID
        var_dump($content); //shows all the information inside of $content
        var_dump($content[0]['subCategories'][0]['questions'][0]); //shows first question of first subcategory of first category of audit 1

        $this->assertTrue(true); //just runs so I can vardump and see what's been retrieved
    }
}
