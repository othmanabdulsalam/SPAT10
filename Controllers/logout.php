<?php
    $view = new stdClass(); //creating the view
    $view->pageTitle = 'Logged out'; //giving tab a name


    //session is started,session details are still saved
    session_start();

    //session is destroyed
    session_destroy();

    //index is loaded to login part
    header("Location: index.php");
