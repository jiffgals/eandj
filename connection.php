<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    
    // connecting to database. connection.php will be attached in login.php page at the top.
    try {
        $conn = new PDO("mysql:host=$servername;dbname=invent", $username, $password);
        // set the PDO error mode to exception.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (\Exception $e) {
        $error_message = $e->getMessage();
    }

?>