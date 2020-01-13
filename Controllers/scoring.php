<?php
    $view = new stdClass(); //creating the view
    $view->pageTitle = 'Scoring an audit'; //giving tab a name

    //session is started
    session_start();





    require("../Views/scoring.phtml");
