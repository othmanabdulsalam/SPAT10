<?php
    $view = new stdClass(); //creating the view
    $view->pageTitle = 'Scoring an audit'; //giving tab a name

    require_once('../Models/AuditQuery.php');

    //session is started
    session_start();
    //grab the auditID from the session
    var_dump($_SESSION['auditID']);
    $auditID = $_SESSION['auditID'];

    //session no longer needs auditID value stored
    unset($_SESSION['auditID']);
    //initialise auditQuery
    $auditQuery = new AuditQuery();
    //query the unscored query and store the results
    $unscoredAudit = $auditQuery->getUnscoredAudit($auditID);

    //set view value currentAudit to be the result of the query
    $view->unscoredAudit = $unscoredAudit;




    require("../Views/scoring.phtml");
