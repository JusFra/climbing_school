<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="content-2">
        <div class="form-table">
            <div class="title">
                <h2>Add new category</h2>
            </div>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>
        
        <form action="" method="POST" enctype="multipart/form-data">

            <table>
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" class="input-field"></td>
                </tr>    
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image" class="input-field-file"></td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="input-field btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $title = $_POST['title'];
                
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //print_r($_FILE['image']);
                //die();

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name != "")
                    {
                        //Rename image
                        $ext = end(explode('.', $image_name));
                        $image_name = "Course_category".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            die();
                        }
                    }

                }
                else
                {
                    $image_name = "";
                }

                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    active='$active'
                ";

                $res = mysqli_query($conn, $sql);

                if($res)
                {
                    $_SESSION['add'] = "<div class='success'>Category added successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>