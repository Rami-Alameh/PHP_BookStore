<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: login.php");
    die();
}

$userEmail = $_SESSION['user_email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>
    <link rel="stylesheet" href="./css/account.css">
</head>

<body>

   <?php include "header.php"?>
    <div class="main-container">
        <div class="account-container">
            <h2>Welcome, Admin!</h2>
            <p>Email: <?php echo $userEmail; ?></p>
    

            <a href="logout.php">Logout</a>
        </div>
    </div>

</body>

</html>