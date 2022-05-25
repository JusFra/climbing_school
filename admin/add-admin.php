<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="content-2">
        <div class="form-table">
            <div class="title">
                <h2>Add new admin</h2>
            </div>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">

            <table>
                <tr>
                    <td>Full name: </td>
                    <td><input type="text" name="full_name" class="input-field" placeholder="Enter Your Name"></td>
                </tr>    
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" class="input-field" placeholder="Enter Your Username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" class="input-field" placeholder="Enter Your Password"></td>
                </tr>
                <tr>
                    <td>License Number: </td>
                    <td><input type="text" name="license" class="input-field" placeholder="Enter Your License Number"></td>
                </tr>
                <tr>
                    <td>License Valid: </td>
                    <td><input type="date" name="valid" class="input-field" placeholder="Enter Your License Valid"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="input-field btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>


<?php
    //Process the value from form and save it in database
    if(isset($_POST['submit']))
    {
        // Button clicked
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);  
        $license = $_POST['license'];
        $valid = $_POST['valid'];
        
        $sql = "INSERT INTO tbl_admin SET 
            full_name = '$full_name',
            username = '$username',
            password = '$password',
            license = '$license',
            valid = '$valid'
        ";

        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        if($res==TRUE)
        {
            //Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin added successfully.</div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to add admin.</div>";
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }


?>