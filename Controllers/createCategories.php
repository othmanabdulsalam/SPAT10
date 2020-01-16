<?php
    /**
     * createCategories controller created by Othman Abdulsalam
     *
     * This controller handles the page for when an admin
     * adds a new category to be stored in the database to be used in future audits
     */

    $view = new stdClass(); //creating a view
    $view->pageTitle = 'Create a new client'; //giving tab a name
    require_once('../Models/UserQuery.php');//require the userQuery class

    session_start();//start session

require_once('../Views/createCategories.phtml');