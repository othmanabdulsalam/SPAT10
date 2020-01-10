<?php
    /**
     * Report Controller By Othman Abdulsalam
     *
     * When a client requests to see a report, a page is loaded with
     * the correct report displaying.
     */

    $view = new stdClass(); //creating the view
    $view->pageTitle = 'Please Login'; //giving tab a name

    require('Views/report.phtml');
