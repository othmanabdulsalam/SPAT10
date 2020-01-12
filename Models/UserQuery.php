<?php
/*
 * created by Michael Jarratt
 *
 * this class is responsible for Querying the database to retrieve information about users
 */

require_once __DIR__."\Database.php";

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
}