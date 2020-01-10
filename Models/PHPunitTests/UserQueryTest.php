<?php
/*
 * created by Michael Jarratt
 *
 * this class is for testing the UserQuery class
 */

use PHPUnit\Framework\TestCase;

require_once __DIR__."\..\Database.php";
require_once __DIR__."\..\UserQuery.php";

class UserQueryTest extends TestCase
{

    public function testGetUsername()
    {
        $userQuery = new UserQuery();
        $user = $userQuery->getUsername(1);
        //var_dump($user);
        $this->assertTrue($user['username'] == "admin");
    }
}
