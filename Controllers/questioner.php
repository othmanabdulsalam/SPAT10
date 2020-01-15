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
    //someone else did this, not exactly sure why but it works i guess
    if(isset($_GET['auditID']))
    {
        $_SESSION['auditID'] = $_GET['auditID'];
    }
    if(isset($_SESSION['auditID']))
    {
        $_GET['auditID'] = $_SESSION['auditID'];
    }
    $auditID = $_GET['auditID'];


    $questionerQuery = new QuestionerQuery();//create AuditQuery object
    $incompleteAudit = $questionerQuery->getQuestionerInfo($auditID);//grab the specific audit the questioner wants to complete
    $view->incompleteAudit = $incompleteAudit;


    if(isset($_POST['answerQuestions']))
    {
        //create empty array
        $arrayQuestionerCompleted = [];
        //grab the count from the phtml
        $count = $_POST['questionCount'];
        //loop until all questions are grabbed
        for($i=1;$i<=$count;$i++)
        {
            $questionArray = [];
            //populate array with data from the first question
            $questionArray['questionID'] = $_POST['questionID'.$i];
            $questionArray['content'] = $_POST['inputAnswer'.$i];
            $questionArray['comment'] = $_POST['inputComment'];

            //push into the larger array that will store everything from the page
            array_push($arrayQuestionerCompleted,$questionArray);
        }

        //pass to query to update the database
        $questionerQuery->submitAnswers($auditID,$arrayQuestionerCompleted);


        //questioner is completed, load them back to the front page
        header('Location: /index.php');
    }






    //require the questioner page
    require_once('../Views/questioner.phtml');


