<?php
    $view = new stdClass(); //creating the view
    $view->pageTitle = 'Scoring an audit'; //giving tab a name

    require_once('../Models/ScoringInfoGetter.php');

    //session is started
    session_start();


    //grab the auditID
    if(isset($_GET['auditID']))
    {
        $auditID = $_GET['auditID'];
    }


    //var_dump($auditID);
    //initialise auditQuery
    $scoringQuery = new ScoringInfoGetter();
    //query the unscored query and store the results
    $unscoredAudit = $scoringQuery->getScoringInfo($auditID);
    //var_dump($unscoredAudit);
    //set view value currentAudit to be the result of the query
    $view->unscoredAudit = $unscoredAudit;




    require("../Views/scoring.phtml");
