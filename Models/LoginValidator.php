<?php
/*
 * created by Michael Jarratt
 * this class compares supplied login information with the database to validate login attempts
 */
require_once __DIR__."/LoginQuery.php";

class LoginValidator
{
    private $loginQuery;

    public function __construct()
    {
        $this->loginQuery = new LoginQuery();
    }

    //takes credentials, returns users tuple if valid, returns nothing otherwise
    public function validate($usernameOrEmail,$password)
    {
        $passwordHash = md5($password); //hashes password for comparison

        $userTuple = $this->loginQuery->fetchUserTuple($usernameOrEmail,$passwordHash)[0]; //takes tuple from array of tuples
        if(isset($userTuple['username'])) //checks if field is set (successfully retrieved)
        {
            //picks out information to return
           /* $userDetails["userID"] = $userTuple['userID']; //takes ID
            $userDetails['username'] = $userTuple['username'];
            $userDetails['email'] = $userTuple['email'];
            $userDetails['accessLevel'] = $userTuple['accessLevel'];
            */
            return $userTuple;
        }
        else
        {
            return null;
        }

    }
}