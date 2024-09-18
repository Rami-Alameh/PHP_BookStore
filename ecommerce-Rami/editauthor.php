<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Category Form</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <?php
    session_start();
    require "conn.php";
    include "header.php";
    $id = $_GET['id'];
    include "./functions/author-functions.php";
    $author =get_author_by_id($conn, $id);

    if ($author == NULL) {
        header("Location: authors.php");
    }
    ?>
    <div class="container">
        <?php

        if (isset($_POST["submit"])) {
            $authorname = $_POST["authorname"];

            $errors = array();

            if (empty($authorname)) {
                array_push($errors, "Please add a author name");
            }

            $authorexistsql = "SELECT * FROM authors WHERE name = '$authorname' AND id != $id";
            $exist = mysqli_query($conn, $authorexistsql);
            $Rowcount = mysqli_num_rows($exist);

            if ($Rowcount > 0) {
                array_push($errors, "author already exists");
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "UPDATE authors SET name=? WHERE id=?";
                $stmt = mysqli_stmt_init($conn);

                if ($prepStmt = mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "si", $authorname, $id);
                    mysqli_stmt_execute($stmt);
                    echo "<div class=''>author updated successfully.</div>";
                    header("location: authors.php");
                } else {
                    die("Error on updating a author");
                }
            }
        }
        ?>

        <form action="" method="POST">
            <div class="form-elements">
                <input type="text" class="control" name="authorname" value="<?php echo $author['name'] ?>">
            </div>
            <div class="form-button">
                <input type="submit" class="btn" value="Update the author" name="submit">
            </div>
            <a style="margin-top: 10px;" href="authors.php">Don't want to update the author anymore!!!</a>
        </form>
    </div>
</body>

</html>
