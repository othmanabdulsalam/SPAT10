<?php


use PHPUnit\Framework\TestCase;

require_once __DIR__."/../Database.php";
require_once __DIR__."/../AuditQuery.php";
require_once __DIR__."/../UserQuery.php";
require_once __DIR__."/../QuestionQuery.php";
require_once __DIR__."/../ScoringInfoGetter.php";

class ScoringInfoGetterTest extends TestCase
{
    public function testGetScoringContent()
    {
        $scoringInfoGetter = new ScoringInfoGetter();
        $scoringInfo = $scoringInfoGetter->getScoringInfo(2);
        var_dump($scoringInfo);
        $this->assertTrue(true);
    }
}
