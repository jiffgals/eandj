<?php
    session_start();

    // remove all sessions variables
    session_unset();

    // destroy
    session_destroy();

    header('location: ../login.php');

?>