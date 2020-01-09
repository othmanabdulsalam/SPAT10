<?php
/*
 * created by Michael Jarratt
 * this class is an interface to get information from the Database class, it contains all queries
 * related to the Login System
 */
require_once("Models/Database.php");

class LoginQuery
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    //retrieves user where their email and password or username and password match
    public function fetchUserTuple($username,$email,$passwordHash)
    {
        return($this->database->retrieve("SELECT * FROM Admins, Clients, Questioners, Scorers 
                                                 WHERE ((Admins.username = $username OR Admin.email = $email) AND Admin.passwordHash = $passwordHash)
                                                 OR ((Clients.username = $username OR Clients.email = $email) AND Clients.passwordHash = $passwordHash)
                                                 OR ((Questioners.username = $username OR Questioner.email = $email) AND Questioner.passwordHash = $passwordHash)
                                                 OR ((Scorers.username = $username OR Scorers.email = $email) AND Scorers.passwordHash = $passwordHash) "));
    }

}