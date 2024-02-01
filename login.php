<?php
    // start the session.
    session_start();
    if(isset($_SESSION['user'])) header('location: dashboard.php');

    $error_message = '';

    if($_POST){
        include('database/connection.php');

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = 'SELECT * FROM users WHERE users.email="'. $username .'" AND users.password="'. $password .'" LIMIT 1';
        $stmt = $conn->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $user = $stmt->fetchAll()[0];
            
            // Captures data of currently login users.
            $_SESSION['$user'] = $user;

            header('location: dashboard.php');
        } else $error_message = 'Please make sure that username and password are correct.';
    }
?>


<DOCTYPE html>
<html>
<head>
    <title>Login - E and J Pharmacy Inventory Management System</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <style>

    </style>
</head>
<body id="loginBody">
    <?php 
        if(!empty($error_message)) { ?>

        <div id="errorMessage">
            <strong>ERROR:</strong> <p><?= $error_message ?> </p>
        </div>
    <?php } ?>
    <div class="container">
        <div class="loginHeader">
            <h1>E and J &nbsp; Pharmacy Admin Login</h1>
            <p>Inventory Management System</p>
        </div>
        <div class="loginBody">
            <form action="login.php" method="POST">
                <div class="loginInputsContainer">
                    <label for="">Username</label>
                    <input type="text" placeholder="username" name="username" type="text" />
                </div>
                <div class="loginInputsContainer">
                    <label for="">Password</label>
                    <input type="password" placeholder="password" name="password" type="password" />
                </div>
                <div>
                    <button>Login</button> <button><a href="../invent/index.php">Back</a></button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>