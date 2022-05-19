<?php include('partials/menu.php'); ?>

        <!-- Main Content Section --> 
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Course</h1>

                <br><br>
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['remove']))
                    {
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['failed-remove']))
                    {
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }
                    if(isset($_SESSION['no-course-found']))
                    {
                        echo $_SESSION['no-course-found'];
                        unset($_SESSION['no-course-found']);
                    }

                ?>
                <br><br>

                <a href="<?php echo SITEURL; ?>admin/add-course.php" class="btn-primary">Add course</a>
                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S. N.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_course";
                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        $sn = 1;

                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $category = $row['category_id'];
                                $active = $row['active'];
                            
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $description; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                <?php 
                                    //echo $image;
                                    if($image_name!="")
                                    {
                                ?>

                                    <img src="<?php echo SITEURL; ?>images/courses/<?php echo $image_name; ?>" width="100px">

                                <?php
                                    } 
                                    else
                                    {
                                        echo "<div class='error'>Image not added.</div>";
                                    }
                                ?>
                                </td>
                                <td>
                                    <?php 

                                        if($category==0)
                                        {
                                            echo "<div class='error'>Category not added.</div>";
                                        }
                                        else
                                        {
                                            $sql2 = "SELECT title FROM tbl_category WHERE id='$category'";
                                            $res2 = mysqli_query($conn, $sql2);
                                            $row2 = mysqli_fetch_assoc($res2);

                                            $category_title = $row2['title'];

                                            echo $category_title;
                                        }
                                        
                                    ?>
                                </td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-course.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Course</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-course.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Course</a>
                                </td>
                            </tr>
                            <?php
                            }
                        }
                        else
                        {
                            ?>
                                <tr>
                                    <td colspan="8"><div class="error">No courses added.</div></td>
                                </tr>
                            <?php
                        }
                    ?>

                </table>
               
                <div class="clearfix"></div>
            </div>
        </div>

<?php include('partials/footer.php'); ?>