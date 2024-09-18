<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add a Book Form</title>
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
        include "./functions/author-functions.php";
        $authors = get_all_authors($conn);
        include "./functions/category-functions.php";
        $categories = get_all_categories($conn);
        include "./functions/upload-cover.php";

        if (isset($_POST["submit"])) {
            $bookname = $_POST["title"];// setting title
            $description = $_POST["description"];// setting desc
            $price = $_POST["price"];// setting price
            $authorId = $_POST["bookAuthor"];// setting author using select 
            $categoryId = $_POST["bookCategory"];// setting category
            $coverFile = uploadCover($_FILES["cover"]);

            $errors = array();
            if(empty($bookname) OR empty($description) OR empty($price)){
                array_push($errors,"Please fill are the fields");//checks if any fields are empty and sends error
            }
            if ($categoryId == 0) {
                array_push($errors, "Please select valid category");//category id 0 not accepted and its 0 by default
            }
            
            if ($authorId == 0) {
                array_push($errors, "Please select a valid author");
            }
            

            $bookexistssql = "SELECT * FROM books WHERE title = '$bookname'";
            $exist = mysqli_query($conn, $bookexistssql);
            $Rowcount = mysqli_num_rows($exist);

            if ($Rowcount > 0) {
                array_push($errors, "Book already exists");
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO books(title, description, price, author_id, category_id, cover) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);

if ($prepStmt = mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "ssiiis", $bookname, $description, $price, $authorId, $categoryId, $coverFile);
    mysqli_stmt_execute($stmt);
    echo "<div class=''>Book added successfully.</div>";
    header("location: products.php");
} else {
    die("Error on adding a book");
}

            }
        }
        ?>
        



        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-elements">
                <input type="text" class="control" name="title" placeholder="Enter Book title: ">
            </div>
            <div class="form-elements">
                <input type="text" class="control" name="description" placeholder="Enter Book Description: ">
            </div>
            <div class="form-elements">
                <input type="number" class="control" name="price" placeholder="Enter Book price: ">
            </div>
            <div class="form-elements">
    <!-- basically shows all ids by setting the value as id and setting text as the actual text-->
                <select class="control" name="bookCategory">
                    <option value="0">Select Category</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-elements">
                <!-- basically shows all ids by setting the value as id and setting text as the actual text-->
                     <select class="control" name="bookAuthor">
                        <option value="0">Select Author</option>
                    <?php foreach ($authors as $author) : ?>
                        <option value="<?php echo $author['id']; ?>"><?php echo $author['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-elements">
            <input type="file" class="box" name="cover" accept="image/jpg, image/jpeg, image/png">
            </div>
            <div class="form-button">
                <input type="submit" class="btn" value="Add Book" name="submit">
            </div>
            <a style="margin-top: 10px;" href="products.php">Don't want to add a Book anymore!!!</a>
        </form>
    </div>
</body>

</html>