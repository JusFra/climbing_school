<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="content-2">
        <div class="form-table">
            <div class="title">
                <h2>Update admin</h2>
            </div>

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

                <table>
                    <tr>
                        <td>Full name: </td>
                        <td><input type="text" class="input-field" name="full_name" value="<?php echo $full_name; ?>"></td>
                    </tr>    
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" class="input-field" name="username" value="<?php echo $username; ?>"></td>
                    </tr>
                    <tr>
                        <td>License Number: </td>
                        <td><input type="text" class="input-field" name="license" value="<?php echo $license; ?>"></td>
                    </tr>
                    <tr>
                        <td>License Valid: </td>
                        <td><input type="date" class="input-field" name="valid" value="<?php echo $valid; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="input-field btn btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
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