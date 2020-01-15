<?php
/*
 * Created by Michael Jarratt and Calvin Blackman
 *
 * this class is for testing the AuditCreationQuery class
 */

use PHPUnit\Framework\TestCase;

require_once __DIR__."/../Database.php";
require_once __DIR__."/../AuditQuery.php";
require_once __DIR__."/../UserQuery.php";
require_once __DIR__."/../QuestionQuery.php";
require_once __DIR__."/../ScoringInfoGetter.php";
require_once __DIR__."/../ScoringInfoGetter.php";
require_once __DIR__."/../QuestionerQuery.php";
require_once __DIR__."/../AuditCreationQuery.php";

class AuditCreationQueryTest extends TestCase
{


    public function testGetAllQuestionsAndCategories()
    {
        $auditCreationQuery = new AuditCreationQuery();
        $result = $auditCreationQuery->getAllQuestionsAndCategories();
        var_dump($result[3]['subCategories'][2]['questions']);
        $this->assertTrue(true);
    }
}
