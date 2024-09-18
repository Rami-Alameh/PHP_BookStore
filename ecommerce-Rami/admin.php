<?php
session_start(); // Start the session

 //Check if the user is not logged in uncomment later
//  if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
//      header("Location: login.php");
//      die();
//  }

// //Access user email and name
// $userEmail = $_SESSION['user_email'];
// $userName = $_SESSION['user_name'];

// // // For admin.php, redirect user to shop.php if they are not an admin
// if ($_SESSION['user_type'] !== 'admin') {
//     header("Location: shop.php");
//     die();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Admin Panel</title>
    <link rel="stylesheet" href="./css/admin.css">
</head>

<body>

<header>
    <div class="logosec">
        <div class="logo">Admin</div>
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png"
             class="icn menuicn" id="menuicn" alt="menu-icon">
    </div>

 

    <div class="message">
        <div class="circle"></div>
        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt="">
        <div class="dp">
           <a href="account.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
                 class="dpicn" alt="dp"></a> 


        </div>
    </div>
</header>

<div class="main-container">
    <div class="navcontainer">
        <nav class="nav">
            <div class="nav-upper-options">
                <div class="nav-option option1">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png"
                         class="nav-img" alt="dashboard">
                    <h3> Dashboard</h3>
                </div>

                <div class="option2 nav-option">
                    <img src="https://t3.ftcdn.net/jpg/02/01/17/30/360_F_201173099_gjRobC0e7nhWrJXoLm54Q3U6OrFGdwq9.jpg" class="nav-img"
                         alt="authors">
                    <h3> Authors</h3>
                </div>

                <div class="nav-option option3">
                    <img src="https://png.pngtree.com/png-clipart/20200224/original/pngtree-tag-icon-for-your-project-png-image_5214108.jpg" class="nav-img"
                         alt="categories">
                    <h3> Categories</h3>
                </div>

                <div class="nav-option option4">
                    <img src="https://w7.pngwing.com/pngs/425/805/png-transparent-computer-icons-book-book-cover-angle-recycling-logo-thumbnail.png" class="nav-img"
                         alt="products">
                    <h3> Products</h3>
                </div>

                <div class="nav-option option5">
                    <img src="https://w7.pngwing.com/pngs/492/790/png-transparent-computer-icons-purchase-order-purchasing-order-form-desktop-wallpaper-black-and-white-purchasing-thumbnail.png" class="nav-img"
                         alt="orders">
                    <h3> Orders</h3>
                </div>

                <div class="nav-option logout">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/7.png" class="nav-img"
                         alt="logout">
                    <a href="logout.php">Logout</a>

                </div>
            </div>
        </nav>
    </div>
    <div class="main">
        <!-- Add your content for Authors, Categories, Products, and Orders sections here -->
    </div>
</div>

</body>

</html>
