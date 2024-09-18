<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location : login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <h1>User Type: <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_type'] : 'Not Set'; ?></h1>

</head>
<body>
    <h1>shop</h1>
    <a href="logout.php"> logout</a>
</body>
</html>