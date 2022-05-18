<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if($res==TRUE)
            {
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //echo "Admin available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username']; 
                    $license = $row['license'];
                    $valid = $row['valid'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {

            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>    
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td>License Number: </td>
                    <td><input type="text" name="license" value="<?php echo $license; ?>"></td>
                </tr>
                <tr>
                    <td>License Valid: </td>
                    <td><input type="date" name="valid" value="<?php echo $valid; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

    if($_POST['submit'])
    {
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $license = $_POST['license'];
        $valid = $_POST['valid'];

        $sql = "UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            license = '$license',
            valid = '$valid'
            WHERE id='$id'
        ";

        $res = mysqli_query($conn, $sql);
        if($res)
        {
            $_SESSION['update'] = "<div class='success'>Admin updated successfully.</div>";
            header('location:'.SITEURL.'/admin/manage-admin.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='error'>Failed to delete admin.</div>";
            header('location:'.SITEURL.'/admin/manage-admin.php');
        }
    }

?>

<?php include('partials/footer.php'); ?>
