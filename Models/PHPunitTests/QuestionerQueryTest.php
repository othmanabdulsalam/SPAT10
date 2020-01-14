<?php
/*
 * Created by Michael Jarratt and Calvin Blackman
 *
 * this class is for testing the QuestionerQuery class
 */

use PHPUnit\Framework\TestCase;

require_once __DIR__."/../Database.php";
require_once __DIR__."/../AuditQuery.php";
require_once __DIR__."/../UserQuery.php";
require_once __DIR__."/../QuestionQuery.php";
require_once __DIR__."/../ScoringInfoGetter.php";
require_once __DIR__."/../ScoringInfoGetter.php";
require_once __DIR__."/../QuestionerQuery.php";

class QuestionerQueryTest extends TestCase
{

    public function testGetQuestionerInfo()
    {
        $questionerQuery = new QuestionerQuery();
        $questionerInfo = $questionerQuery->getQuestionerInfo(3);
        //var_dump($questionerInfo);
        //var_dump($questionerInfo['questions'][0]);
        var_dump($questionerInfo['questions'][0]['subCategories'][0]);
        $this->assertTrue(true);
    }
}
