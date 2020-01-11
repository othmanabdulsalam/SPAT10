<?php


use PHPUnit\Framework\TestCase;

require_once __DIR__."/../Database.php";
require_once __DIR__."/../SubCatQuery.php";

class SubCatQueryTest extends TestCase
{

    public function testGetCatID()
    {
        $subCatQuery = new SubCatQuery();

        $result1 = $subCatQuery->getCatID(1);
        $this->assertTrue($result1[0] == 1);

        $result2 = $subCatQuery->getCatID("1,4,7");
        $this->assertTrue($result2[0] == 1 && $result2[1] == 2 && $result2[2] == 3);
    }
}
