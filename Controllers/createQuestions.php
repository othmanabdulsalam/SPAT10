<?php
/**
 * createQuestions controller created by Jayant Kabaria
 *
 * This controller handles the page for when an admin
 * adds a new question to be stored in the database to be used in future audits
 */
session_start();//start session
if(isset($_SESSION['loggedIn']) && ($_SESSION['accessLevel'] == 'A')) {
    $view = new stdClass(); //creating a view
    $view->pageTitle = 'Create a new question'; //giving tab a name
    require_once('../Models/AuditCreationQuery.php');//require the userQuery class

    $auditCreationQuery = new AuditCreationQuery();//create AuditQuery object
    $questionInfo = $auditCreationQuery->getAllAuditCreationInfo();//grab the information required for the view
    $view->questionInfo = $questionInfo;


    if (isset($_POST['makeQuestion'])) {

        $questionQuery = new questionQuery();
        //pass the information to the database so an question has been created
        $questionQuery->createNewQuestion($_POST['questionContent'], $_POST['selectSubCategory'], $_POST['mark1'], $_POST['mark2'], $_POST['mark3'], $_POST['mark4'], $_POST['mark5']);
        //load the index.php page
        header('Location: ../index.php');
    }
    require_once('../Views/createQuestions.phtml');
}