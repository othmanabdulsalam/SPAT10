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
        //return($this->database->retrieve("SELECT * FROM Admins, Clients, Questioners, Scorers
        //                                         WHERE ((Admins.username = $username OR Admins.email = $email) AND Admins.passwordHash = $passwordHash)
        //                                         OR ((Clients.username = $username OR Clients.email = $email) AND Clients.passwordHash = $passwordHash)
        //                                         OR ((Questioners.username = $username OR Questioners.email = $email) AND Questioners.passwordHash = $passwordHash)
        //                                         OR ((Scorers.username = $username OR Scorers.email = $email) AND Scorers.passwordHash = $passwordHash) "));

        //tries to fetch admins
        $tuple = $this->database->retrieve("SELECT username, passwordHash, email, accessLevel FROM Admins WHERE (username= \"$usernameOrEmail\" OR email =\"$usernameOrEmail\") AND passwordHash = \"$passwordHash\"");
        if(!isset($tuple[0]['username'])) //if it did not fetch a client
        {
            //tries to fetch client
            $tuple = $this->database->retrieve("SELECT username, passwordHash, email, accessLevel FROM Clients WHERE (username= \"$usernameOrEmail\" OR email =\"$usernameOrEmail\") AND passwordHash = \"$passwordHash\"");
        }
        if(!isset($tuple[0]['username'])) //if it did not fetch a client
        {
            //tries to fetch Questioner
            $tuple = $this->database->retrieve("SELECT username, passwordHash, email, accessLevel FROM Questioners WHERE (username= \"$usernameOrEmail\" OR email =\"$usernameOrEmail\") AND passwordHash = \"$passwordHash\"");
        }
        if(!isset($tuple[0]['username'])) //if it did not fetch a questioner
        {
            //tries to fetch Scorer
            $tuple = $this->database->retrieve("SELECT username, passwordHash, email, accessLevel FROM Scorers WHERE (username= \"$usernameOrEmail\" OR email =\"$usernameOrEmail\") AND passwordHash = \"$passwordHash\"");
        }

        //returns either empty tuple or filled tuple of login was valid
        return $tuple;
    }

}