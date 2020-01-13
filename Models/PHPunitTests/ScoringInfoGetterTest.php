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

    public function testidk()
    {
        $var = [];
        $var['i1'] = 1;
        $var['i2'] = 2;
        $var['i3'] = 3;

        $int = 1;
        while ($int<4)
        {
            $index = 'i'.$int;
            echo $var[$index];
            $int++;
        }

        $this->assertTrue(true);
    }
}
