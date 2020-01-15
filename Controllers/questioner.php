<?php
    /**
     * questioner.php created by Othman Abdulsalam
     *
     * This controller handles the grabbing of a selected incomplete audit
     * for the questioner to work on
     */

    $view = new stdClass(); //creating the view
    $view->pageTitle = 'Questions'; //giving tab a name
    require_once('Models/AuditQuery.php'); //for querying the audits that need to be displayed

    session_start();//start session
    $auditID = $_GET;

    $auditQuery = new AuditQuery();//create AuditQuery object
    $incompleteAudit = $auditQuery->getInProgressAudit($auditID);//grab the specific audit the questioner wants to complete

    $view->incompleteAudit = $incompleteAudit;

    //require the questioner page
    //require_once('../Views/questioner.phtml');


