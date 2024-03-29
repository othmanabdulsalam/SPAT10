<?php
/*
 * created by Michael Jarratt
 *
 * tests CategoryQuery class
 */

use PHPUnit\Framework\TestCase;

require_once __DIR__."/../Database.php";
require_once __DIR__."/../CategoryQuery.php";


class CategoryQueryTest extends TestCase
{

    public function testGetCategoryIDs()
    {
        $categoryQuery = new CategoryQuery();
        $result1 = $categoryQuery->getCategoryIDs(1);
        $this->assertTrue($result1[0] == 1);
        $result2 = $categoryQuery->getCategoryIDs("1,4,7");
        $this->assertTrue($result2[0]==1 && $result2[1]==2 && $result2[2]==3);
    }

    public function testGetCategories()
    {
        $categoryQuery = new CategoryQuery();
        $result = $categoryQuery->getCategories("1,2,3");
        var_dump($result);
        self::assertTrue($result[0]["catID"] == 1);
    }
    public function testCreateNewCategories()
    {
        $categoryQuery = new CategoryQuery();
        $categoryQuery->createNewCategory("bbb","lol");
        $this->assertTrue(true);
    }
}
