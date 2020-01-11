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

    /*
     * takes a single subCategory ID or list ("1,2,3"...) and returns the Categories
     * they belong to
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
}