<?php
    $view = new stdClass(); //creating the view
    $view->pageTitle = 'Scoring an audit'; //giving tab a name

    require_once('../Models/ScoringInfoGetter.php');

    //session is started
    session_start();


    //grab the auditID
    if(isset($_GET['auditID']))
    {
        $_SESSION['auditID'] = $_GET['auditID'];
    }
    if(isset($_SESSION['auditID']))
    {
        $_GET['auditID'] = $_SESSION['auditID'];
    }
    $auditID = $_GET['auditID'];


    //initialise auditQuery
    $scoringQuery = new ScoringInfoGetter();
    //query the unscored query and store the results
    $unscoredAudit = $scoringQuery->getScoringInfo($auditID);
    //set view value currentAudit to be the result of the query
    $view->unscoredAudit = $unscoredAudit;

    //if the Score button is clicked
    if(isset($_POST['scoreAudit']))
    {
        //initialise an empty array
        $arrayScoresAndComments = [];
        //grab the number of questions for the audit passed from the scoring.phtml
        $questionCount = $_POST['questionCount'];
        //initialise a for loop to do the conditions
        for($Q=1; $Q<=$questionCount; $Q++)
        {
            //initialise empty array
            $scoreArray = [];
            //populate the scoreArray with values
            $scoreArray['questionID'] = $_POST['questionID'.$Q];
            $scoreArray['score'] = $_POST['inputScore'.$Q];
            $scoreArray['comment'] = $_POST['inputComment'.$Q];

            //push the arrays containing values into main array
            array_push($arrayScoresAndComments, $scoreArray);
        }
        $scoreQuery = new ScoreQuery;
        //pass the auditID and array to submitScores query in ScoreQuery
        $scoreQuery->submitScores($auditID, $arrayScoresAndComments);
        header("Location: /index.php");
    }


    require("../Views/scoring.phtml");
