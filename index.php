<?php include('partials-front/menu.php'); ?>

    <!-- Courses search section starts here -->
    <section class="course-search">
        <div class="container">

            <form action="<?php echo SITEURL; ?>course-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for courses.."> 
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- Courses search section ends here -->

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- Categories section starts here -->
    <section class="categories">
        <div class="container">
            <h1 class="text-center">Explore Courses</h1>

            <?php
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' LIMIT 3";
                $res = mysqli_query($conn, $sql);
                
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-courses.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Category not added.</div>";
                }
            ?>


            <div class="clearfix"></div>    
        </div>
    </section>
    <!-- Categories section ends here -->

    <!-- Courses menu section starts here -->
    <section class="course-menu">
        <div class="container">
            <h2 class="text-center">Next Courses</h2>

            <?php
                $sql = "SELECT * FROM tbl_course WHERE active='Yes' LIMIT 4";
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
                        $price = round($row['price']);
                        $image_name = $row['image_name'];
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
                                    <img src="<?php echo SITEURL; ?>images/courses/<?php echo $image_name; ?>" alt="Jura" class="img-responsive img-curve">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="course-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p><?php echo date_format($date_start, 'd.m'); ?> - <?php echo date_format($date_end, 'd.m.Y'); ?></p>
                                <p class="course-price"><?php echo $price; ?> zł</p>
                                <p class="course-detail"><?php echo $description; ?></p>
                                <br>
                                <a href="<?php echo SITEURL; ?>reservation.php?course_id=<?php echo $id; ?>" class="btn btn-primary">Order now</a>
                            </div>
                            <div class="clearfix"></div>
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
            <br>
            <p class="text-center">
                <a href="<?php echo SITEURL; ?>course.php">See all courses</a>   
            </p>
  
    </section>
    <!-- Courses menu section ends here -->

    <?php include('partials-front/footer.php'); ?>