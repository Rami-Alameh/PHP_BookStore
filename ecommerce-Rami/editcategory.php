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
    include "./functions/category-functions.php";
    $category = get_category_by_id($conn, $id);

    if ($category == NULL) {
        header("Location: categories.php");
    }
    ?>
    <div class="container">
        <?php

        if (isset($_POST["submit"])) {
            $categoryname = $_POST["categoryname"];

            $errors = array();

            if (empty($categoryname)) {
                array_push($errors, "Please add a category name");
            }

            $categoryexistsql = "SELECT * FROM categories WHERE name = '$categoryname' AND id != $id";
            $exist = mysqli_query($conn, $categoryexistsql);
            $Rowcount = mysqli_num_rows($exist);

            if ($Rowcount > 0) {
                array_push($errors, "Category already exists");
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "UPDATE categories SET name=? WHERE id=?";
                $stmt = mysqli_stmt_init($conn);

                if ($prepStmt = mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "si", $categoryname, $id);
                    mysqli_stmt_execute($stmt);
                    echo "<div class=''>Category updated successfully.</div>";
                    header("location: categories.php");
                } else {
                    die("Error on updating a category");
                }
            }
        }
        ?>

        <form action="" method="POST">
            <div class="form-elements">
                <input type="text" class="control" name="categoryname" value="<?php echo $category['name'] ?>">
            </div>
            <div class="form-button">
                <input type="submit" class="btn" value="Update the Category" name="submit">
            </div>
            <a style="margin-top: 10px;" href="categories.php">Don't want to update a Category anymore!!!</a>
        </form>
    </div>
</body>

</html>
