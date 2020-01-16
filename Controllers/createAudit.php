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
    require_once('../Models/UserQuery.php');//require the userQuery class

    session_start();//start session

require_once('../Views/createAudit.phtml');
