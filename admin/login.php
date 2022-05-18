<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Climbing School Reservation System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>

            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username"><br><br>

                Password: <br>
                <input type="password" name="password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>

            <br><br>
            <p class="text-center">Created by <a href="#">Justyna Frankiewicz</a></p>
        </div>
    </body>
</html>


<?php

    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class='success text-center'>Login successfull.</div>";
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            $_SESSION['login'] = "<div class='error text-center'>Username or password did not match.</div>";
        }

    }

?>