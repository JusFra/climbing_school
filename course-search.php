<?php include('partials-front/menu.php'); ?>

    <!-- sEARCH Section Starts Here -->
    <section class="course-search text-center">
        <div class="container">

            <?php
                $search = $_POST['search'];
            ?>
            
            <h2>Course on Your Search <a href="#" class="text-search">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- sEARCH Section Ends Here -->



    <!-- MEnu Section Starts Here -->
    <section class="course-menu">
        <div class="container">
            <h2 class="text-center">Course Menu</h2>

            <?php

                $sql = "SELECT * FROM tbl_course WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
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