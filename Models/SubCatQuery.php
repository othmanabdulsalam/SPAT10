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

    /*
     * takes a single question ID or list ("1,2,3"...) and returns the subCategories
     * they belong to
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
}