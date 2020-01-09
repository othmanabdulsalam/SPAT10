<?php
    $view = new stdClass(); //creating the view
    $view->pageTitle = 'Please Login'; //giving tab a name
    //require_once('Models/LoginValidator.php');

    //session is started
    session_start();

    //check if login button has been clicked
    if(isset($_POST['submit']))
    {
        //username and password set to what was input, will be passed to method later
        $username = $_POST['username'];
        $password = $_POST['password'];

        //Once button is clicked, grab user data from the loginValidator class
        //$loginValidator = new LoginValidator();
        //$loginDetails = $loginValidator->logUserIn($username,$password)
        //if no details, that means the details input were incorrect
        //if(!$loginDetails)
        //{
            //if details where entered incorrectly, output error message
            //$view->loginError = "Incorrect Login Details, please try again";
        //}
        //otherwise, set session user details to be
        //else
        //{
            //session has variables set to indicate a user has logged in
            //$_SESSION['userID'] = $logUserIn['userID'];
            //$_SESSION['userName'] = $logUserIn['userName'];
            //$_SESSION['userName'] = $logUserIn['userName'];
            //$_SESSION['userName'] = $logUserIn['userName'];
            //$_SESSION['userName'] = $logUserIn['userName'];
            //$_SESSION['userName'] = $logUserIn['userName'];
            //header("Location: index.php");
        //}
    }

    require("Views/index.phtml");