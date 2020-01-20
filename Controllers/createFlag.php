<?php
/**
 * createCategories controller created by Jayant Kabaria
 *
 * This controller handles the page for when an admin
 * adds a new flag to be stored in the database to be used in future audits
 */

$view = new stdClass(); //creating a view
$view->pageTitle = 'Create a new flag'; //giving tab a name
require_once('../Models/FlagQuery.php');//require the categoryQuery class
session_start();//start session

if(isset($_POST['makeFlag']))
{
    //set the values from the phtml file
    $flagDescription = $_POST['flagDescription'];

    //make call t the query to add the subcategory to the database
    $FlagQuery = new FlagQuery();
    $FlagQuery->createNewFlag($flagDescription);

    //load back to index
    header('Location: /index.php');
}

require_once('../Views/createFlag.phtml');