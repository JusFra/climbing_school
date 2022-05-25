<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="content-2">
        <div class="data-table">
            <div class="title">
                <h2>Manage category</h2>
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn">Add Category</a>
            </div>

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
                    if(isset($_SESSION['no-category-found']))
                    {
                        echo $_SESSION['no-category-found'];
                        unset($_SESSION['no-category-found']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['failed-remove']))
                    {
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }
                ?>
                <br><br>


                <table>
                    <tr>
                        <th>S. N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);

                        if($res)
                        {
                            $count = mysqli_num_rows($res);

                            $sn = 1;

                            if($count > 0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                                    $image_name = $rows['image_name'];
                                    $active = $rows['active'];
                                    ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $title; ?></td>
                                            <td>
                                                <?php 
                                                    //echo $image;
                                                    if($image_name!="")
                                                    {
                                                        ?>

                                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">

                                                        <?php
                                                    } 
                                                    else
                                                    {
                                                        echo "<div class='error'>Image not added.</div>";
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $active; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn btn-secondary">Update Category</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn btn-danger">Delete Category</a>
                                            </td>
                                        </tr>

                                    <?php
                                }    
                            }
                            else
                            {
                                ?>
                                <tr>
                                    <td colspan="5"><div class="error">No category added.</div></td>
                                </tr>
                                <?php

                            }
                        }
                    ?>

                </table>

            </div>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>