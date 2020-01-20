<?php
/*
 * created by Michael Jarratt
 * this class is an interface to get information from the Database class, it contains all queries
 * related to the Login System
 */
require_once __DIR__."/Database.php";

class LoginQuery
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    //retrieves user where their email and password or username and password match
    public function fetchUserTuple($usernameOrEmail,$passwordHash)
    {
        //tries to fetch user
        $tuple = $this->database->retrieve("SELECT userID, username, email, accessLevel FROM Users WHERE (username = \"$usernameOrEmail\" OR email=\"$usernameOrEmail\") AND passwordHash = \"$passwordHash\"");
        if(!isset($tuple[0]['username'])) //if it did not fetch a scorer
        {
            //create empty tuple
            //var_dump($tuple);
            $temp = [];
            $temp['username'] = null;
            $tuple[0] =$temp;
        }

        //returns either empty tuple or filled tuple of login was valid
        return $tuple;
    }

}