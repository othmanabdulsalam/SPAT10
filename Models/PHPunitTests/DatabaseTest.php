<?php


use PHPUnit\Framework\TestCase;
require_once __DIR__."\..\Database.php"; //absolute path for PHP query

class DatabaseTest extends TestCase
{

    public function testGetInstance()
    {
        $database = Database::getInstance();
        $this->assertTrue(isset($database));
    }

    public function testRetrieve()
    {
        $database = Database::getInstance();
        $username = $database->retrieve("SELECT username FROM Admins")[0]['username'];
        var_dump($username);
        $this->assertTrue($username == "admin");
    }
}
