<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Add a category Form</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
<?php 
include "header.php";
?>
<div class="container">
    <?php
    session_start();
    require "conn.php";

    if (isset($_POST["submit"])) {
        $categoryname = $_POST["categoryname"];

        $errors = array();

        if (empty($categoryname)) {
            array_push($errors, "Please add a category name");
        }

        $categoryexistsql = "SELECT * FROM categories WHERE name = '$categoryname'";
        $exist = mysqli_query($conn, $categoryexistsql);
        $Rowcount = mysqli_num_rows($exist);

        if ($Rowcount > 0) {
            array_push($errors, "category already exists");
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            require "conn.php";
            $sql = "INSERT INTO categories(name) VALUES (?)";
            $stmt = mysqli_stmt_init($conn);

            if ($prepStmt = mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $categoryname);
                mysqli_stmt_execute($stmt);
                echo "<div class=''>category added successfully.</div>";
                header("location: categories.php");
            } else {
                die("Error on adding an category");
            }
        }
    }
    ?>

    <form action="" method="POST">
        <div class="form-elements">
            <input type="text" class="control" name="categoryname" placeholder="Enter category name: ">
        </div>

        <div class="form-button">
            <input type="submit" class="btn" value="Add Category" name="submit">
        </div>
        <a style="margin-top: 10px;" href="categories.php">Don't want to add a Category anymore!!!</a>
    </form>
</div>
</body>
</html>

