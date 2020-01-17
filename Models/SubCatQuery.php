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
     * returns array containing list of subcategory ID's that hold supplied questions
     *
     * @param String $questionID list of question IDs to get subCategories of "1,2,3"...
     * @return array containing list of subCategory IDs
     */
    public function getSubCatID($questionID)
    {
        $raw = $this->database->retrieve("SELECT DISTINCT subCatID FROM Questions WHERE questionID IN ($questionID)");
        $questionIDList = [];
        foreach ($raw as $tuple)
        {
            array_push($questionIDList,$tuple['subCatID']);
        }
        return $questionIDList;
    }

    /**
     * returns tuples from subCategories which are children of category and are within list of subCatIDs
     *
     * @param String $categoryID category to get children of
     * @param String $subcatIDs subcategories which are part of the audit
     * @return array
     */
    public function getSubCategories($categoryID,$subcatIDs)
    {
        return $this->database->retrieve("SELECT * FROM SubCategories WHERE catID = \"$categoryID\" AND subCatID IN ($subcatIDs)");
    }

    /**
     * returns tuples from SubCategories that are children of category
     *
     * @param $catID
     * @return array of SubCategory Tuples (- catID)
     */
    public function getAllSubcategories($catID)
    {
        return $this->database->retrieve("SELECT subCatID, subCatCode, subCatDescription FROM SubCategories WHERE catID = \"$catID\"");
    }

    /**
     * Creates new subCategories
     *
     * @param String $subCatCode
     * @param String $subCatDescription
     * @param int $catID
     */
    public function createNewSubCategories($subCatCode,$subCatDescription,$catID)
    {
        $this->database->update("INSERT INTO SubCategories (subCatCode,subCatDescription,catID) VALUES (\"$subCatCode\",\"$subCatDescription\",\"$catID\")");
    }
}