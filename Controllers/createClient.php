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
    if(isset($_POST['makeClient']))
    {
        //grab all the information from the page
        $username = $_POST['username'];
        $email = $_POST['email'];
        //hash the two passwords
        $password = md5($_POST['password']);
        $passwordCheck = md5($_POST['passwordCheck']);
        //check if hashed passwords do not match
        if($password !== $passwordCheck)
        {
            //if no, then set view error
            $view->passwordNoMatch = 'Sorry, the passwords do not match, please make sure they are the same';
        }
        //if they do match
        else
        {
            //create userQuery object
            $userQuery = new UserQuery();
            //pass the client details to the createClient query
            $userQuery->createClient($username,$email,$password);
            //load the index page again
            header('Location: ../index.php');
        }
    }


    //require the createClient phtml file
    require_once('../Views/createClient.phtml');