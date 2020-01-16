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

    //check if create audit button is set
    //if(isset($_POST['createAudit']))
    //{
        //
        //set audit's values
        //$clientID = $_POST['clientID'];
        //loop through every questionID and store to a questionIDArray
        //$questionIDArray = [];
        //$location = $_POST['location'];
        //some bullshit for the questionFlags array, idk still figuring that one out
        //$auditCreationQuery = new AuditCreationQuery();
        //$auditCreationQuery->submitAudit();
        //header('Location: ../index.php');
    //}
