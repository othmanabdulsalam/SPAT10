<?php
    /**
     * questioner.php created by Othman Abdulsalam
     *
     * This controller handles the grabbing of a selected incomplete audit
     * for the questioner to work on
     */

    $view = new stdClass(); //creating the view
    $view->pageTitle = 'Questions'; //giving tab a name
    require_once('../Models/QuestionerQuery.php'); //for querying the audits that need to be displayed

    session_start();//start session
if(isset($_GET['auditID']))
{
    $_SESSION['auditID'] = $_GET['auditID'];
}
if(isset($_SESSION['auditID']))
{
    $_GET['auditID'] = $_SESSION['auditID'];
}
$auditID = $_GET['auditID'];


    $auditQuery = new QuestionerQuery();//create AuditQuery object
    $incompleteAudit = $auditQuery->getQuestionerInfo($auditID);//grab the specific audit the questioner wants to complete
    $view->incompleteAudit = $incompleteAudit;

    //require the questioner page
    require_once('../Views/questioner.phtml');


