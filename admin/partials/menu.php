<?php 
    include('../config/constants.php'); 
    include('login-check.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin Panel</title> 
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>Admin Panel</h1>
        </div>
        <ul>
            <li><a href="index.php"><img src="../images/gps.png" alt="">&nbsp; <span>DASHBOARD</span></a></li>
            <li><a href="manage-admin.php"><img src="../images/climbing.png" alt="">&nbsp; <span>ADMINS</span></a></li>
            <li><a href="manage-category.php"><img src="../images/pickaxe.png" alt="">&nbsp; <span>CATEGORIES</span></a></li>
            <li><a href="manage-course.php"><img src="../images/carabiner.png" alt="">&nbsp; <span>COURSES</span></a></li>
            <li><a href="manage-reservation.php"><img src="../images/diary.png" alt="">&nbsp; <span>RESERVATIONS</span></a></li>
            <li><a href="<?php echo SITEURL; ?>"><img src="../images/web.png" alt="">&nbsp; <span>WEBSITE</span></a></li>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
            <div class="school-title">
                    <h1>Climbing School</h1>
                </div>
                <a href="logout.php">
                    <div class="user">
                        <div class="img-case">
                            <img src="../images/user (4).png" alt="">
                        </div>
                        <div class="overlay">
                            <div class="text">Logout</div>
                        </div>
                    </div>

                </a>
                
            </div>
        </div>