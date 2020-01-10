<?php
/*
 * created by Michael Jarratt
 * this class is an interface to get information from the Database class, it contains all queries
 * related to the Login System
 */
require_once __DIR__."\Database.php";

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
//        //tries to fetch admins
//        $tuple = $this->database->retrieve("SELECT AdminID, username, passwordHash, email, accessLevel FROM Admins WHERE (username= \"$usernameOrEmail\" OR email =\"$usernameOrEmail\") AND passwordHash = \"$passwordHash\"");
//        if(!isset($tuple[0]['username'])) //if it did not fetch a client
//        {
//            //tries to fetch client
//            $tuple = $this->database->retrieve("SELECT clientID, username, passwordHash, email, accessLevel FROM Clients WHERE (username= \"$usernameOrEmail\" OR email =\"$usernameOrEmail\") AND passwordHash = \"$passwordHash\"");
//        }
//        if(!isset($tuple[0]['username'])) //if it did not fetch a client
//        {
//            //tries to fetch Questioner
//            $tuple = $this->database->retrieve("SELECT questionerID, username, passwordHash, email, accessLevel FROM Questioners WHERE (username= \"$usernameOrEmail\" OR email =\"$usernameOrEmail\") AND passwordHash = \"$passwordHash\"");
//        }
//        if(!isset($tuple[0]['username'])) //if it did not fetch a questioner
//        {
//            //tries to fetch Scorer
//            $tuple = $this->database->retrieve("SELECT scorerID, username, passwordHash, email, accessLevel FROM Scorers WHERE (username= \"$usernameOrEmail\" OR email =\"$usernameOrEmail\") AND passwordHash = \"$passwordHash\"");
//        }
        //tries to fetch user
        $tuple = $this->database->retrieve("SELECT userID, username, email, accessLevel FROM Users WHERE (username = \"$usernameOrEmail\" OR email=\"$usernameOrEmail\") AND passwordHash = \"$passwordHash\"");
        if(!isset($tuple[0]['username'])) //if it did not fetch a scorer
        {
            //create empty tuple
            var_dump($tuple);
            $temp = [];
            $temp['username'] = null;
            $tuple[0] =$temp;
        }

        //returns either empty tuple or filled tuple of login was valid
        return $tuple;
    }

}