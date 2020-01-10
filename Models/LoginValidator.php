<?php
/*
 * created by Michael Jarratt
 * this class compares supplied login information with the database to validate login attempts
 */
require_once("Models/LoginQuery.php");

class LoginValidator
{
    private $loginQuery;

    public function __construct()
    {
        $this->loginQuery = new LoginQuery();
    }

    //takes credentials, returns users tuple if valid, returns nothing otherwise
    public function validate($username,$email,$password)
    {
        $passwordHash = md5($password); //hashes password for comparison
        if(!isset($username))
        {
            $username = ""; //if username is null (not entered by user) it is set to empty string
        }
        else
        {
            $email = ""; //else email has not been set, so email is changed from nul to empty string
        }
        $userTuple = $this->loginQuery->fetchUserTuple($username,$email,$passwordHash)[0]; //takes tuple from array of tuples

        if(isset($userTuple[0])) //checks if field is set (successfully retrieved)
        {
            //picks out information to return
            $userDetails["userID"] = $userTuple[0]; //takes ID
            $userDetails['username'] = $userTuple['username'];
            $userDetails['email'] = $userTuple['email'];
            $userDetails['accessLevel'] = $userTuple['accessLevel'];
            return $userDetails;
        }
        else
        {
            return null;
        }

    }
}