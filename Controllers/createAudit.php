<?php
    /**
     * createAudit controller by Othman Abdulsalam
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
    //if(isset($_POST['createAudit']))
    //{
        //set audit's values
        //$clientID = $_POST['clientID'];
        //$questionIDArray = [];
        //$questionIDCount = $_POST['questionIDCount'];
        //for($i=0;$i<=$questionIDCount;$i++)
        //{
            //$questionID = $_POST['questionID'.$i];
            //array_push($questionIDArray,$questionID);
        //}
        //$questionFlagArray = []
        //$questionFlagCount = $_POST['questionFlagCount'];
        //for($i=0;$i<=$questionFlagCount;$i++)
        //{
            //$questionFlag = []
            //$questionFlag['questionID'] = $_POST['questionID'.$i];
            //$questionFlag['flagID'] = $_POST['flagID'.$i];
            //array_push($questionFlagArray,$questionFlag);
        //}
        //$location = $_POST['location'];
        //some bullshit for the questionFlags array, idk still figuring that one out
        //$auditCreationQuery = new AuditCreationQuery();
        //$auditCreationQuery->submitAudit($clientID,$location,$questionIDArray,$questionFlagArray);
        //header('Location: ../index.php');
    //}
require_once('../Views/createAudit.phtml');
