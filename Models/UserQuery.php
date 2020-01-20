<?php
/*
 * created by Michael Jarratt
 *
 * this class is responsible for Querying the database to retrieve information about users
 */

require_once __DIR__."/Database.php";

class UserQuery
{

    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    /*
     * gets the username of a client referenced by ID
     */
    public function getUsername($userID)
    {
        return $this->database->retrieve("SELECT username FROM Users Where userID = \"$userID\"")[0];
    }

    /**
     * Creates a client user with information provided
     *
     * @param String $username
     * @param String $email
     * @param String $passwordHash
     */
    public function createClient($username,$email,$passwordHash)
    {
        $this->createUser($username,$email,$passwordHash,"C"); //passes information to createUser
    }

    /**
     * creates user using provided information
     *
     * @param $username
     * @param $email
     * @param $passwordHash
     * @param $accessLevel
     */
    private function createUser($username,$email,$passwordHash,$accessLevel)
    {
        $this->database->update("INSERT INTO Users (username, passwordHash, email, accessLevel) VALUES(\"$username\",\"$passwordHash\",\"$email\",\"$accessLevel\")");
    }

    /**
     * Returns array of client tuples in the following format:
     * (array) Clients
     *  [0..X]
     *      'userID'    => (String)
     *      'username'  => (String)
     *
     *
     * @return array
     */
    public function getAllClients()
    {
        return $this->database->retrieve("SELECT userID, username FROM Users WHERE accessLevel = \"C\" ");
    }

}