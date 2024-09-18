
<!DOCTYPE html>
<style>
    .authornav {
            padding: 10px;
            background-color: grey;
        }

        .authornav a {
            margin-right: 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            font-size: 16px;
            
        }

    </style>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" href="./css/adminbooks.css">
</head>
<body>
    <?php 
    session_start();
    require("conn.php");
    include "./functions/author-functions.php";
    $authors = get_all_authors($conn);
    include "./functions/category-functions.php";
    $categories = get_all_categories($conn);
    ?>
    <?php
    include "header.php";
    
    ?>

<nav class="authornav">
        <a class="authornav" href="add-book.php" style="font-size: 18px;">Add a book</a>
    </nav>
    <?php
    $booksql = "SELECT * FROM books ORDER by price desc";
    $result = $conn->query($booksql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Title</th><th>Author ID</th><th>Category ID</th><th>Description</th><th>Price</th><th>Cover</th><th>Action</th></tr>';
        while ($book = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $book['id'] . '</td>';
            echo '<td>' . $book['title'] . '</td>';
        
            if (isset($authors[$book['author_id']])) {
                echo '<td>' . $authors[$book['author_id']]['name'] . '</td>';
            } else {
                echo '<td> Undefined </td>';
            }
        
            if (isset($categories[$book['category_id']])) {
                echo '<td>' . $categories[$book['category_id']]['name'] . '</td>';
            } else {
                echo '<td> Undefined </td>';
            }
            
            echo '<td>' . $book['description'] . '</td>';
            echo '<td>' . $book['price'] . '$</td>';
            echo '<td>' . '<img width=120 height=120 src="./cover_uploads/' . $book['cover'] . '">' . '</td>';
            echo '<td><a class="edit" href="edit-book.php?id=' . $book['id'] . '">Edit</a>';
            echo '<a class="delete" href="deleteproduct.php?id=' . $book['id'] . '">Delete</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No books found.</p>';
    }

    
    ?>
    
</body>
</html>
