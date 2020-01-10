<?php
    $view = new stdClass(); //creating the view
    $view->pageTitle = 'Please Login'; //giving tab a name
    require_once('Models/LoginValidator.php');

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
        $userDetails = $loginValidator->validate($usernameOrEmail,null,$password); //need to find a way to identify email
        //if no details, that means the details input were incorrect
        if(!isset($userDetails))
        {
            //if details where entered incorrectly, output error message
            $view->loginError = "Incorrect Login Details, please try again";
        }
        else
        {
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $userDetails['username'];
            $_SESSION['C'] = $userDetails['accessLevel'];
            var_dump($_SESSION['loggedIn']);
            //session has been set, refresh page where user will be logged in and their options displayed
            session_start();
            $_SESSION['userID'] = $userDetails['userID'];
            $_SESSION['username'] = $userDetails['username'];
            header("Location: index.php");
        }
    }

    require("Views/index.phtml");