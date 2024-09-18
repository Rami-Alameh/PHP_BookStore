<?php
session_start();
require("conn.php");
include "./functions/author-functions.php";
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
    <title>Authors</title>
    <link rel="stylesheet" href="./css/adminbooks.css">
</head>
<body>
    <?php
    include "header.php";
    $authors = get_all_authors($conn);
    ?>

    <h2 style="padding-left: 550px;">Authors</h2>
    <nav class="authornav">
        <a class="authornav" href="add-author.php" style="font-size: 18px;">Add a author</a>
    </nav>

    <?php if ($authors): ?>
        <table>
            <tr>
                <th>Author ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($authors as $author): ?>
                <tr>
                    <td><?php echo $author['id']; ?></td>
                    <td><?php echo $author['name']; ?></td>
                    <td>
                        <a class="edit" href="editauthor.php?id=<?php echo $author['id']; ?>">Edit</a>
                        <a class="delete" href="deleteauthor.php?id=<?php echo $author['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No authors found.</p>
    <?php endif; ?>


</body>
</html>
