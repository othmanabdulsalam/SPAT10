<?php
/*
 * Created by Michael Jarratt
 *
 * this class serves the purpose of storing queries related to subCategories
 */

require_once __DIR__."/Database.php";

class SubCatQuery
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    /**
     * @param String $questionID list of question IDs to get subCategories of "1,2,3"...
     * @return array containing list of category IDs
     */
    public function getCatID($questionID)
    {
        $raw = $this->database->retrieve("SELECT subCatID FROM Questions WHERE questionID IN ($questionID)");
        $questionIDList = [];
        foreach ($raw as $tuple)
        {
            array_push($questionIDList,$tuple['subCatID']);
        }
        return $questionIDList;
    }

    /**
     * returns tuples from categories table
     * @param String $categoryID category IDs to get subcats of -"1,2,3"...
     * @return array of category tuples
     */
    public function getSubCategories($categoryID)
    {
        return $this->database->retrieve("SELECT * FROM SubCategories WHERE catID IN ($categoryID)");
    }
}