<?php
/**
 * createCategories controller created by Othman Abdulsalam/Jayant Kabaria
 *
 * This controller handles the page for when an admin
 * adds a new category to be stored in the database to be used in future audits
 */

    $view = new stdClass(); //creating a view
    $view->pageTitle = 'Create a new client'; //giving tab a name
    require_once('../Models/SubCatQuery.php');//require the subCatQuery class
    require_once('../Models/AuditCreationQuery.php');//require the AuditCreationQuery class
    session_start();//start session

    $auditCreationQuery = new AuditCreationQuery();//create AuditQuery object
    $categoryInfo = $auditCreationQuery->getAllAuditCreationInfo();//grab the information required for the view
    $view->categoryInfo = $categoryInfo;

    //check if makeSubCategories button is pressed
    if(isset($_POST['makeSubCategory']))
    {
        //set the values from the phtml file
        $subCatCode = $_POST['subCategoryCode'];
        $subCatDescription = $_POST['subCategoryName'];
        $catID = $_POST['selectCategory'];

        //make call to the query to add the subcategory to the database
        $subCatQuery = new SubCatQuery();
        $subCatQuery->createNewSubCategory($subCatCode,$subCatDescription,$catID);

        //load back to index
        header('Location: /index.php');
    }

    require_once('../Views/createSubCategories.phtml');