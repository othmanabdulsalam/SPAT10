<?php
    /**
     * Logout Controller by Othman Abdulsalam
     *
     * Whenever logout button in the header is clicked, link to this controller
     * is activated
     *
     * All session details are destroyed and index is loaded to the login part
     */

    //session is started,session details are still saved
    session_start();

    //session is destroyed
    session_destroy();

    //index is loaded to login part
    header("Location: /index.php");
