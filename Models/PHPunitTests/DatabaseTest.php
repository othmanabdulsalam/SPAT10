<?php


use PHPUnit\Framework\TestCase;
require __DIR__."\..\Database.php";
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
