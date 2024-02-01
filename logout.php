<?php
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');

    // remove all sessions variables
    session_unset();

    // destroy
    session_destroy();

?>