<?php
session_start(); // Start the session

require "conn.php";

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: shop.php');//relocate to the shop
    exit();
}

if (isset($_POST["submit"])) {
    $email = $_POST["email"];//getting user input
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE email = '$email'";//quering the db to for email 
    $result = mysqli_query($conn, $sql);
    $loggedUser = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if (mysqli_num_rows($result) > 0) {
        if ($loggedUser) {
            if (password_verify($password, $loggedUser["password"])) {//verifies the password 
                $_SESSION['user_id'] = $loggedUser['id'];
                $_SESSION['user_email'] = $loggedUser['email'];
                $_SESSION['user_name'] = $loggedUser['name'];
                $_SESSION['user_type'] = $loggedUser['user_type'];
                $_SESSION['user'] = 'true';

                if ($loggedUser['user_type'] == 'admin') {
                    header("Location: admin.php");
                    die();
                } elseif ($loggedUser['user_type'] == 'user') {
                    header("Location: shop.php");
                    die();
                }
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="container">
        <form action="login.php" method="post">
            <div class="form-elements">
                <input type="email" class="control" name="email" placeholder="Enter email: ">
            </div>
            <div class="form-elements">
                <input type="password" class="control" name="password" placeholder="Enter password: ">
            </div>
            <div class="form-button">
                <input type="submit" class="btn" value="login" name="submit">
            </div>
            <a href="Register.php">Don't have an account!!!</a>
        </form>
    </div>
</body>

</html>
