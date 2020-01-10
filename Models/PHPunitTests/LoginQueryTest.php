<?php


use PHPUnit\Framework\TestCase;
require_once __DIR__."\..\LoginQuery.php"; //absolute path for PHP query
require_once __DIR__."\..\Database.php"; //absolute path for PHP query
class LoginQueryTest extends TestCase
{

    public function testFetchUserTuple()
    {
        $loginQuery = new LoginQuery();
        //gets admin
        $tuple = $loginQuery->fetchUserTuple("admin",md5("admin"))[0];
        //var_dump($tuple);
        $this->assertTrue($tuple['username'] == "admin");
        //gets client
        $tuple = $loginQuery->fetchUserTuple("client",md5("client"))[0];
        //var_dump($tuple);
        $this->assertTrue($tuple['username'] == "client");
        //gets questioner
        $tuple = $loginQuery->fetchUserTuple("questioner", md5("questioner"))[0];
        //var_dump($tuple);
        $this->assertTrue($tuple['username'] == "questioner");
        //gets scorer
        $tuple = $loginQuery->fetchUserTuple("scorer",  md5("scorer"))[0];
        $this->assertTrue($tuple['username'] == "scorer");
        //checks invalid login
        $tuple = $loginQuery->fetchUserTuple("invalid", "invalid");
        $this->assertTrue(!isset($tuple[0]));

    }
}
