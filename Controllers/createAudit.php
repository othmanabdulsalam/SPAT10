<?php
    /**
     * createAudit controller by Jayant Kabaria/Othman Abdulsalam
     *
     * This controller will generate a client's audit that
     * questioners and scorers will work on before
     * it is completed and to be viewed by the client
     */

    $view = new stdClass(); //creating a view
    $view->pageTitle = 'Create a new audit'; //giving tab a name
    require_once('../Models/AuditCreationQuery.php');//require the userQuery class

    session_start();//start session
    $auditCreationQuery = new AuditCreationQuery();//create AuditQuery object
    $auditInfo = $auditCreationQuery->getAllAuditCreationInfo();//grab the specific audit the questioner wants to complete
    $view->auditInfo = $auditInfo;

    //check if create audit button is set
    if(isset($_POST['createAudit']))
    {
        //set audit's values
        $clientID = $_POST['clientID']; //grab clientID
        $location = $_POST['location'];//grab the location
        $questionIDArray = [];//fill array of questionIDs
        $subCatCount = $_POST['subCatCount'];
        for ($i=1; $i <= $subCatCount; $i++)
        {
            if(isset($_POST['questionID'.$i])) {
                $questionIDs = $_POST['questionID' . $i];
                foreach ($questionIDs as $questionID) {
                    array_push($questionIDArray, $questionID);
                }
            }
        }

        $questionFlagArray = [];//fill array of question flags
        for($i=1;$i<=$subCatCount;$i++)
        {
            $questionFlag = [];
            if(isset($_POST['selectQuestionToFlag'.$i]) && strlen($_POST['selectQuestionToFlag'.$i]) != 0) {

                    $questionFlag['questionID'] = $_POST['selectQuestionToFlag' . $i];

                if (isset($_POST['flagID'.$i]) && strlen($_POST['flagID'.$i]) != 0) {

                    $questionFlag['flagID'] = $_POST['flagID' . $i];
                    array_push($questionFlagArray, $questionFlag);
                }
            }
        }

        $auditCreationQuery = new AuditCreationQuery();
        //pass the information to the database so an audit has been created
        $auditCreationQuery->submitAudit($clientID,$location,$questionIDArray,$questionFlagArray);
        //load the index.php page
        header('Location: ../index.php');
    }
require_once('../Views/createAudit.phtml');
