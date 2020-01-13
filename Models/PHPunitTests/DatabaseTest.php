<?php


use PHPUnit\Framework\TestCase;
<<<<<<< HEAD
require_once __DIR__."\..\Database.php"; //absolute path for PHP query
=======
require __DIR__."\..\Database.php";
>>>>>>> e1c4409f5cb1460703d1d55de111e9b3d3815f1d
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
