<?php
    
    //session is started,session details are still saved
    session_start();

    //session is destroyed
    session_destroy();

    //index is loaded to login part
    header("Location: index.php");
