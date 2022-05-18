<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm password: </td>
                    <td>
                        <input type="password" name="confirm_password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //echo "User found";
                if($new_password==$confirm_password)
                {
                    //Update the password
                    $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id=$id
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to change password.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password did not pitch.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                $_SESSION['user-not-found'] = "<div class='error'>User not found.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
    }

?>

<?php include('partials/footer.php'); ?>