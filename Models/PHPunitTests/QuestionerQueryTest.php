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
        var_dump($questionerInfo); //array
        var_dump($questionerInfo['questions'][0]);
        var_dump($questionerInfo['questions'][0]['subCategories'][0]);
        $this->assertTrue(true);
    }

    public function testSubmitAnswers()
    {
        $questionerQuery = new QuestionerQuery();
        $auditID = 3;

        //creates answers for 3 questions and pushes them to answer array
        $answer = [];
        $answer['questionID'] = 1;
        $answer['content'] = "answering text to do an answer";
        $answer['comment'] = ""; //no comment

        $answers = [];
        array_push($answers,$answer);

        $answer = [];
        $answer['questionID'] = 2;
        $answer['content'] = "answering text to do an answer for question 2";
        $answer['comment'] = "yeah this answer seems legit ngl";
        array_push($answers,$answer);

        $answer = [];
        $answer['questionID'] = 3;
        $answer['content'] = "this is the answer to question number three";
        $answer['comment'] = "nah bro this guy's full of it innit";
        array_push($answers,$answer);

        $questionerQuery->submitAnswers($auditID,$answers);

        $this->assertTrue(true); //just runs query then go check result in database
    }
}
