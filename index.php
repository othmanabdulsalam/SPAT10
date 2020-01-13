<?php
    /**
     * Index Controller created by Othman Abdulsalam
     *
     * Index is the login screen when no login has been successful
     *
     * If login is successful, page is reloaded with appropriate user options
     * displayed and navigation across the website becomes possible
     */
    $view = new stdClass(); //creating the view
    $view->pageTitle = 'Please Login'; //giving tab a name
    require_once('Models/LoginValidator.php'); //for validating login
    require_once('Models/AuditQuery.php'); //for querying the audits that need to be displayed

    //session is started
    session_start();

    //check if login button has been clicked
    if(isset($_POST['submit']))
    {
        //username and password set to what was input, will be passed to method later
        $usernameOrEmail = $_POST['username'];
        $password = $_POST['password'];

        //Once button is clicked, grab user data from the loginValidator class
        $loginValidator = new LoginValidator();
        $userDetails = $loginValidator->validate($usernameOrEmail,$password); //need to find a way to identify email
        //if no details, that means the details input were incorrect
        if(!isset($userDetails))
        {
            //if details where entered incorrectly, output error message
            $view->loginError = "Incorrect Login Details, please try again";
        }
        //details have been retrieved
        else
        {
            //set session variables for loggedIn, userID, username & accessLevel
            $_SESSION['loggedIn'] = true;
            $_SESSION['userID'] = $userDetails['userID'];
            $_SESSION['username'] = $userDetails['username'];
            $_SESSION['accessLevel'] = $userDetails['accessLevel'];


            //session has been set, refresh page where user will be logged in and their options displayed
            header("Location: index.php");

        }


    }

    //check if the user was a client
    if(isset($_SESSION['userID']) && $_SESSION['accessLevel'] == 'C')
    {
        // initialise the audit query
        $auditQuery = new AuditQuery();
        //grab result of client's audits and set to variable
        $clientAudits = $auditQuery->getAudits($_SESSION['userID']);
        //create view variable
        $view->clientAudits = $clientAudits;
    }

    if(isset($_SESSION['userID']) && $_SESSION['accessLevel'] == 'S')
    {
        // initialise the audit query
        $auditQuery = new AuditQuery();

        //grab all audits that have not been scored
        $unscoredAudits = $auditQuery->getUnscoredAudits();

        $view->unscoredAudits = $unscoredAudits;

        if(isset($_POST['scoreAudit']))
        {
            header("Location: /Controllers/scoring.php");
        }
    }

    //phtml file for the index page
    require("Views/index.phtml");