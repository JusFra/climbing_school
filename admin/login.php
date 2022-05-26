<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Climbing School Reservation System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="content">
            <div class="content-2">
                <div class="form-table">
                    <div class="title">
                        <h1 class="text-center">Login</h1>
                    </div>
                    <br><br>

                    <?php
                        if(isset($_SESSION['login']))
                        {
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
                        }
                        if(isset($_SESSION['no-login-message']))
                        {
                            echo $_SESSION['no-login-message'];
                            unset($_SESSION['no-login-message']);
                        }
                    ?>

                    <div class="login">
                        <form action="" method="POST" class="text-center">
                            Username: <br>
                            <input type="text" name="username" class="input-field"><br><br>

                            Password: <br>
                            <input type="password" name="password" class="input-field"><br><br>

                            <input type="submit" name="submit" value="Login" class="btn btn-primary">
                        </form>
                    </div>
                </div>    
            </div>
        </div>
    </body>
</html>


<?php

    if(isset($_POST['submit']))
    {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class='success text-center'>Login successfull.</div>";
            $_SESSION['user'] = $username;

            header('location:'.SITEURL.'admin/index.php');
        }
        else
        {
            $_SESSION['login'] = "<div class='error text-center'>Username or password did not match.</div>";
            header('location:'.SITEURL.'admin/login.php');
        }

    }

?>