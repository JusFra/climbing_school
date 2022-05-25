<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="content-2">
        <div class="form-table">
            <div class="title">
                <h2>Update Course</h2>
            </div>

        <?php

            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql1 = "SELECT * FROM tbl_course WHERE id=$id";
                $res1 = mysqli_query($conn, $sql1);

                $count1 = mysqli_num_rows($res1);
                if($count1==1)
                {
                    $row1 = mysqli_fetch_assoc($res1);

                    $title = $row1['title'];
                    $date_start = $row1['date_start'];
                    $date_end = $row1['date_end'];            
                    $description = $row1['description'];
                    $price = $row1['price'];
                    $current_image = $row1['image_name'];
                    $current_category = $row1['category_id'];
                    $active = $row1['active'];
                }
                else
                {
                    $_SESSION['no-course-found'] = "<div class='error'>Course not found.</div>";
                    header('location:'.SITEURL.'admin/manage-course.php');
                }
                
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }  
        ?>


        <form action="" method="POST" enctype="multipart/form-data">

            <table>
                <tr>
                    <td>Title: </td>
                    <td><input type="text" class="input-field" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Start date: </td>
                    <td><input type="date" class="input-field" name="date_start" value="<?php echo $date_start; ?>"></td>
                </tr>
                <tr>
                    <td>End date: </td>
                    <td><input type="date" class="input-field" name="date_end" value="<?php echo $date_end; ?>"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" class="input-field-area"><?php echo $description; ?></textarea>
                    </td>
                </tr> 
                <tr>
                    <td>Price: </td>
                    <td><input type="number" class="input-field" name="price" value="<?php echo $price; ?>"></td>
                </tr>   
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/courses/<?php echo $current_image; ?>" width="100px">
                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>Image not added.</div>";
                            }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image" class="input-field-file">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
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
                                        $category_id = $row['id'];
                                        $category_title = $row['title'];
                                        ?>
                                        <option <?php if($current_category==$category_id){ echo "selected"; } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
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
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Course" class="input-field btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $date_start = $_POST['date_start'];
                $date_end = $_POST['date_end'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $active = $_POST['active'];

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name !="")
                    {
                        $ext = end(explode('.', $image_name));
                        $image_name = "Course_photo".rand(0000, 9999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/courses/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            header('location:'.SITEURL.'admin/manage-course.php');
                            die();
                        }

                        if($current_image != "")
                        {
                            $remove_path = "../images/courses/".$current_image; 
                            $remove = unlink($remove_path);

                            if($remove==false)
                            {
                                $_SESSION['failed-remove'] = "Failed to remove current image.";
                                header('location:'.SITEURL.'admin/manage-course.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;                    
                }

                $sql2 = "UPDATE tbl_course SET
                    title='$title',
                    date_start='$date_start',
                    date_end='$date_end',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id='$category',
                    active='$active'
                    WHERE id=$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    $_SESSION['update'] = "<div class='success'>Course updated successfully.</div>";
                    header('location:'.SITEURL.'/admin/manage-course.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to update course.</div>";
                    header('location:'.SITEURL.'/admin/manage-course.php');
                }
            }

        ?>

        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>
