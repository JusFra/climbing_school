<?php include('partials-front/menu.php'); ?>

<?php
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];

        $sql = "SELECT title FROM tbl_category WHERE id=$category_id;";
        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    }
    else
    {
        header('location:'.SITEURL);
    }
?>

    <!-- sEARCH Section Starts Here -->
    <section class="course-search text-center">
        <div class="container">
            
            <h2>Courses on <a href="#" class="text-search">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- sEARCH Section Ends Here -->



    <!-- MEnu Section Starts Here -->
    <section class="course-menu">
        <div class="container">
            <h2 class="text-center">Course Menu</h2>

            <?php

                $sql = "SELECT * FROM tbl_course WHERE category_id=$category_id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $date_start = DateTime::createFromFormat('Y-m-d', $row['date_start']);
                        $date_end = DateTime::createFromFormat('Y-m-d', $row['date_end']);
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $active = $row['active'];
                        ?>

                            <div class="course-menu-box">
                                <div class="course-menu-img">
                                    <?php
                                        if($image_name=="")
                                        {
                                            echo "<div class='error'>Image not added.</div>";
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/courses/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                                <div class="course-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p><?php echo date_format($date_start, 'd.m'); ?> - <?php echo date_format($date_end, 'd.m.Y'); ?></p>
                                    <p class="course-price"><?php echo $price; ?> zł</p>
                                    <p class="course-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>
                                    <?php
                                        if($active=='Yes')
                                        {
                                            ?>
                                            <a href="<?php echo SITEURL; ?>reservation.php?course_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                            <?php
                                        }
                                        else{
                                            echo "<div class='error'>No places</div>";
                                        }
                                    ?>
                                    
                                </div>
                            </div>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Course not found.</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- Menu Section Ends Here -->

    
<?php include('partials-front/footer.php'); ?>