<?php
/*
 * Created by Michael Jarratt
 *
 * this class serves the purpose of storing queries related to Categories
 */

require_once __DIR__."/Database.php";

class CategoryQuery
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }


    /**
     * @param String $subCatID list of category IDs formatted "1,2,3"...
     * @return array containing IDs of categories containing the supplied subcategories
     */
    public function getCategoryIDs($subCatID)
    {
        $raw = $this->database->retrieve("SELECT catID FROM SubCategories WHERE subCatID IN ($subCatID)");
        $questionIDList = [];
        foreach ($raw as $tuple) //for each tuple returned
        {
            array_push($questionIDList,$tuple['catID']); //extracts cat ID from tuples
        }
        return $questionIDList;
    }

    /**
     * returns of tuples from the Categories table with supplied ID
     *
     * @param String $catIDs ID(s) of all categories to fetch information of "1,2,3"...
     *
     * @return array containing Category tuples
     */
    public function getCategories($catIDs)
    {
        return $this->database->retrieve("SELECT * FROM Categories WHERE catID IN ($catIDs)");
    }

    /**
     * returns all tuples from the Category table
     *
     * @param null
     *
     * @return array containing Category tuples
     */
    public function getAllCategories()
    {
        return $this->database->retrieve("SELECT * FROM Categories");
    }
}