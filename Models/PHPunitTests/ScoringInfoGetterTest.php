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
        //var_dump($scoringInfo);
        echo "scoringInfo['scoringContent']";
        var_dump($scoringInfo['scoringContent']); // shows categories
        echo "scoringInfo['scoringContent']['0']";
        var_dump($scoringInfo['scoringContent']['0']);
        echo "first subCategory of category 1";
        var_dump($scoringInfo['scoringContent'][0]['subCategories'][0]);
        var_dump($scoringInfo['scoringContent'][0]['subCategories'][0]['questions'][0]['answer']['evidence']);
        $this->assertTrue(true);
    }


    //this has nothing to do with scoring info, it's a proof of concept for incrementing through an associatively index array
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
