<?php
/**
* createCategories controller created by Othman Abdulsalam
*
* This controller handles the page for when an admin
* adds a new category to be stored in the database to be used in future audits
*/
session_start();//start session
if(isset($_SESSION['loggedIn']) && ($_SESSION['accessLevel'] == 'A')) {
    $view = new stdClass(); //creating a view
    $view->pageTitle = 'Create a new categories'; //giving tab a name
    require_once('../Models/CategoryQuery.php');//require the categoryQuery class


    if (isset($_POST['makeCategory'])) {
        //set the values from the phtml file
        $catCode = $_POST['categoryCode'];
        $catDescription = $_POST['categoryDescription'];

        //make call t the query to add the subcategory to the database
        $CategoryQuery = new CategoryQuery();
        $CategoryQuery->createNewCategory($catCode, $catDescription);

        //load back to index
        header('Location: /index.php');
    }

    require_once('../Views/createCategories.phtml');
}