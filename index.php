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
            //set session variables
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $userDetails['username'];
            $_SESSION['accessLevel'] = $userDetails['accessLevel'];
            //session has been set, refresh page where user will be logged in and their options displayed
            header("Location: index.php");
        }
    }

    require("Views/index.phtml");