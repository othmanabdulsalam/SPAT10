<?php
    /**
     * createClient controller created by Othman Abdulsalam
     *
     * This controller is passed the new client information and makes checks that
     * the two passwords after they are hashed in md5 match, an if they do,
     * the new client can be created
     */
    $view = new stdClass(); //creating a view
    $view->pageTitle = 'Create a new client'; //giving tab a name
    require_once('../Models/UserQuery.php');//require the userQuery class

    session_start();//start session

    //if admin presses create client account
    //{
        //grab all the information from the page
        //hash the two passwords
        //check if hashed passwords do not match
        //{
            //if no, then set view error
            //$view->clientCreateError = '';
        //}
        //if they do match
        //{
            //create userQuery object
            //pass the client details to the createClient query
            //load the index page again
        //}
    //}


    //require the createClient phtml file
    //require_once('../Views/createClient.phtml');