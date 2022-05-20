<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="course-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>course-search.php" method="POST">
                <input type="search" name="search" placeholder="Search..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="course-menu">
        <div class="container">
            <h2 class="text-center">All Courses</h2>

                <?php
                    $sql = "SELECT * FROM tbl_course";
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
                                            <a href="#" class="btn btn-primary">Order Now</a>
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
                        echo "<div class='error'>Course not added.</div>";
                    }
                ?>

           

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


<?php include('partials-front/footer.php'); ?>