/*
* created by Michael Jarratt
* this class processes queries, it can either run inserts and return nothing,
* or can run selects and return the results as an associative index.
* this is a singleton class
*/
<?php


class Database
{
    private $connection; //PDO to interact with database
    static private $database; //holds an instance of itself (singleton)

    private function __construct()
    {
        $serverName = "poseidon.salford.ac.uk";
        $username = "hackcamp10";
        $password = "ITvf6adLXvLNjmP";
        $this->connection = new PDO("mysql:host=$serverName;dbname=sye564_forum", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //sets error mode to create an exception saying what went wrong
    }

    //returns instance of Database
    public static function getInstance()
    {
        if(!isset(self::$database)) //if an instance does not already exist
        {
            self::$database = new Database();
        }
        return self::$database;
    }

    /*
     *  Executes SELECT queries and returns any results in the form of an associatively indexed array
     */
    public function retrieve($query)
    {
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC); //sets array to associative indexing
        $result = $statement->fetchAll();
        return $result;
    }

    /*
     * executes any query that updates the database, does not return output
     */
    public function update($query)
    {
        $statement = $this->connection->prepare($query);
        $statement->execute();
    }
}