<?php


use PHPUnit\Framework\TestCase;


require_once __DIR__."\..\LoginValidator.php"; //absolute path for PHP query
require_once __DIR__."\..\LoginQuery.php"; //absolute path for PHP query
require_once __DIR__."\..\Database.php"; //absolute path for PHP query

class LoginValidatorTest extends TestCase
{

    public function testValidate()
    {
        $loginvalidator = new LoginValidator();
        $userDetails = $loginvalidator->validate("client","client");
        //var_dump($userDetails);
        $this->assertTrue($userDetails['accessLevel'] == "C");
    }
}
