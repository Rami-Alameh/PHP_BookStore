<?php
session_start();
require("conn.php");
include "./functions/category-functions.php";
?>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="./css/adminbooks.css">
</head>
<body>
    
    <?php
    include "header.php";
    $categories = get_all_categories($conn);
    ?>
<h2 style="padding-left: 550px;">Categories</h2>
    <nav class="authornav">
        <a class="authornav" href="add-category.php" style="font-size: 18px;">Add a category</a>
    </nav>
    

    <?php if ($categories): ?>
        <table>
            <tr>
                <th>Category ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo $category['id']; ?></td>
                    <td><?php echo $category['name']; ?></td>
                    <td>
                        <a class="edit" href="editcategory.php?id=<?php echo $category['id']; ?>">Edit</a>
                        <a class="delete" href="deletecategory.php?id=<?php echo $category['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No categories found.</p>
    <?php endif; ?>


</body>
</html>
