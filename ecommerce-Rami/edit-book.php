<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Book Form</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <?php
    include "header.php";
    session_start();
    require "conn.php";
    include "./functions/author-functions.php";
    $authors = get_all_authors($conn);
    include "./functions/category-functions.php";
    $categories = get_all_categories($conn);
    include "./functions/upload-cover.php";
    include "./functions/book-functions.php";

    $id = $_GET['id'];
    $book = get_book_by_id($conn, $id);

    if ($book == null) {
        header("Location: products.php");
    }

    if (isset($_POST["submit"])) {
        $bookname = $_POST["title"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $authorId = $_POST["bookAuthor"];
        $categoryId = $_POST["bookCategory"];
        $coverFile = isset($_FILES["cover"]) && $_FILES["cover"]["size"] > 0 ? uploadCover($_FILES["cover"]) : $book['cover'];

        $errors = array();

        if (empty($bookname) OR empty($description) OR empty($price) OR empty($coverFile)) {
            array_push($errors, "Please fill in all the fields");
        }

        if ($categoryId == 0) {
            array_push($errors, "Please select a valid category");
        }

        if ($authorId == 0) {
            array_push($errors, "Please select a valid author");
        }

        

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            // Update book details
            $sql = "UPDATE books SET title=?, description=?, price=?, author_id=?, category_id=?, cover=? WHERE id=?";
            $stmt = mysqli_stmt_init($conn);

            if ($prepStmt = mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssiiisi", $bookname, $description, $price, $authorId, $categoryId, $coverFile, $id);
                mysqli_stmt_execute($stmt);
                echo "<div class=''>Book updated successfully.</div>";
                header("location: products.php");
            } else {
                die("Error on updating a book");
            }
        }
    }
    ?>

    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-elements">
                <input type="text" class="control" name="title" value="<?php echo $book['title']; ?>" placeholder="Enter Book title">
            </div>
            <div class="form-elements">
                <input type="text" class="control" name="description" value="<?php echo $book['description']; ?>" placeholder="Enter Book Description">
            </div>
            <div class="form-elements">
                <input type="number" class="control" name="price" value="<?php echo $book['price']; ?>" placeholder="Enter Book price">
            </div>
            <div class="form-elements">
                <!-- similar to add products we select a category here -->
                <select class="control" name="bookCategory">
                    <option value="0">Select Category</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo ($book['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                            <?php echo $category['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- similar to add products we select a author here -->
            <div class="form-elements">
                <select class="control" name="bookAuthor">
                    <option value="0">Select Author</option>
                    <?php foreach ($authors as $author) : ?>
                        <option value="<?php echo $author['id']; ?>" <?php echo ($book['author_id'] == $author['id']) ? 'selected' : ''; ?>>
                            <?php echo $author['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-elements">
                <input type="file" class="box" value="<?php echo $book['cover']; ?>" name="cover" accept="image/jpg, image/jpeg, image/png">
            </div>
            <div class="form-button">
                <input type="submit" class="btn" value="Update Book" name="submit">
            </div>
            <a style="margin-top: 10px;" href="products.php">Don't want to update a Book anymore!!!</a>
        </form>
    </div>
</body>

</html>
