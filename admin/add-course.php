<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="content-2">
        <div class="form-table">
            <div class="title">
                <h2>Add course</h2>
            </div>

        <?php
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
                    <td>Start date: </td>
                    <td><input type="date" name="date_start" class="input-field"></td>
                </tr> 
                <tr>
                    <td>End date: </td>
                    <td><input type="date" name="date_end" class="input-field"></td>
                </tr> 
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" class="input-field-area"></textarea>
                    </td>
                </tr> 
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" class="input-field"></td>
                </tr>  
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image" class="input-field-file"></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" class="input-field">

                            <?php
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">No category found</option>
                                    <?php
                                }
                            ?>

                        </select>
                    </td>
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
                        <input type="submit" name="submit" value="Add Course" class="input-field btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        $title = $_POST['title'];
        $date_start = $_POST['date_start'];
        $date_end = $_POST['date_end'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active = "No";
        }

        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];

            if($image_name!="")
            {
                $ext = end(explode('.', $image_name));
                $image_name = "Course-photo".rand(0000, 9999).".".$ext;

                $src = $_FILES['image']['tmp_name'];
                $dst = "../images/courses/".$image_name;

                $upload = move_uploaded_file($src, $dst);

                if($upload==false)
                {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                    header('location:'.SITEURL.'admin/add-course.php');
                    die();
                }
            }
        }
        else
        {
            $image_name = "";
        }


        $sql2 = "INSERT INTO tbl_course SET
            title = '$title',
            date_start='$date_start',
            date_end='$date_end',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            active = '$active'
        ";

        $res2 = mysqli_query($conn, $sql2);

        if($res2==true)
        {
            $_SESSION['add'] = "<div class='success'>Course added successfully.</div>";
            //header('location:'.SITEURL.'/admin/manage-course.php');
            echo("<script>location.href = '".SITEURL."admin/manage-course.php';</script>");
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to add course.</div>";
            //header('location:'.SITEURL.'/admin/manage-course.php');
            echo("<script>location.href = '".SITEURL."admin/manage-course.php';</script>");
        }
    }

?>


<?php include('partials/footer.php'); ?>