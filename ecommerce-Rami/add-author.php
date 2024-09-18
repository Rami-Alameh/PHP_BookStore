<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Add an author Form</title>
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
        $authorname = $_POST["authorname"];

        $errors = array();

        if (empty($authorname)) {
            array_push($errors, "Please add an author name");
        }

        $authorexistsql = "SELECT * FROM authors WHERE name = '$authorname'";
        $exist = mysqli_query($conn, $authorexistsql);
        $Rowcount = mysqli_num_rows($exist);

        if ($Rowcount > 0) {
            array_push($errors, "Author already exists");
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            require "conn.php";
            $sql = "INSERT INTO authors(name) VALUES (?)";
            $stmt = mysqli_stmt_init($conn);

            if ($prepStmt = mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $authorname);
                mysqli_stmt_execute($stmt);
                echo "<div class=''>Author added successfully.</div>";
                header("location: authors.php");
            } else {
                die("Error on adding an author");
            }
        }
    }
    ?>

    <form action="" method="POST">
        <div class="form-elements">
            <input type="text" class="control" name="authorname" placeholder="Enter authorname: ">
        </div>

        <div class="form-button">
            <input type="submit" class="btn" value="Add Author" name="submit">
        </div>
        <a href="authors.php">Don't want to add an author anymore!!!</a>
    </form>
</div>
</body>
</html>

