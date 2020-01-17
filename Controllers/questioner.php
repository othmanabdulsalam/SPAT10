<?php
    /**
     * questioner.php created by Othman Abdulsalam
     *
     * This controller handles the grabbing of a selected incomplete audit
     * for the questioner to work on
     */

    $view = new stdClass(); //creating the view
    $view->pageTitle = 'Questions'; //giving tab a name
    require_once('../Models/QuestionerQuery.php'); //for querying the audits that need to be displayed#
    require_once('../Models/EvidenceProcessor.php');

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

    //if questioner has pressed the answer questions button
    if(isset($_POST['answerQuestions']))
    {
        $evidenceProcessor = new EvidenceProcessor();
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
            $questionArray['comment'] = $_POST['inputComment'.$i];
            //check if evidence has been submitted
            //var_dump($_FILES);
            if($_FILES['file'.$i]['error']!=4) //if file was selected (error 4 = no file chosen)
            {
                $evidenceProcessor->submitEvidence($auditID,$questionArray['questionID'],$_FILES['file'.$i]);
            }
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


