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

    public function testSubmitQuestionToAudit()
    {
        $questionQuery = new QuestionQuery();
        $questionQuery->submitQuestionToAudit(5,2);
        $this->assertTrue(true);
    }

    public function testCreateNewQuestion()
    {
        $questionQuery = new QuestionQuery();
        $questionQuery->createNewQuestion("lol",2, "a","b","c","d","e");
        $this->assertTrue(true);
    }
}
