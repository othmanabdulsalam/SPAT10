<?php
/*
 * created by Michael Jarratt
 *
 * tests QuestionQuery class
 */

use PHPUnit\Framework\TestCase;

require_once __DIR__."\..\Database.php";
require_once __DIR__."\..\QuestionQuery.php";

class QuestionQueryTest extends TestCase
{

    public function testGetAuditQuestions()
    {
        $questionQuery = new QuestionQuery();
        $questionList = $questionQuery->getAuditQuestions(1);
        var_dump($questionList);
        $this->assertTrue($questionList[0]['questionID'] == 1);
    }

    public function  testGetQuestionIDs()
    {
        $questionQuery = new QuestionQuery();
        $questionList = $questionQuery->getQuestionIDs(2);
        $this->assertTrue($questionList[0] == 1);
    }
}
