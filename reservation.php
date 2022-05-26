<?php include('partials-front/menu.php'); ?>

<?php
    if(isset($_GET['course_id']))
    {
        $course_id = $_GET['course_id'];

        $sql = "SELECT * FROM tbl_course WHERE id=$course_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $row = mysqli_fetch_assoc($res);

            $id = $row['id'];
            $title = $row['title'];
            $date_start = DateTime::createFromFormat('Y-m-d', $row['date_start']);
            $date_end = DateTime::createFromFormat('Y-m-d', $row['date_end']);
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            header('location:'.SITEURL);
        }
    }
    else
    {
        header('location:'.SITEURL);
    }
?>


    <section class="course-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your reservation</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Course</legend>

                    <div class="course-menu-img">
                        <?php
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image not added.</div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/courses/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                        
                    </div>
    
                    <div class="course-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="course_name" value="<?php echo $title; ?>">

                        <p class="course-price"><?php echo $price; ?> zł</p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <p class="course-price"><?php echo date_format($date_start, 'd.m'); ?> - <?php echo date_format($date_end, 'd.m.Y'); ?></p> 
                        <input type="hidden" name="course_id" value="<?php echo $id; ?>">
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Jan Nowak" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 123 123 123" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. nowak@gmail.com" class="input-responsive" required>

                    <div class="order-label">Climbing equipment hire (harness, helmet, boots): + 120 zł</div>
                    <input type="radio" name="equipment" value="Yes">Yes
                    <input type="radio" name="equipment" value="No">No
                    
                    <br><br>
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    $course_name = $_POST['course_name'];
                    $course_price = $_POST['price'];
                    $course_id = $_POST['course_id'];

                    if(isset($_POST['equipment']))
                    {
                        $equipment = $_POST['equipment'];
                    }
                    else
                    {
                        $equipment = "No";
                    }

                    if($equipment=='Yes')
                    {
                        $total = $course_price + 120;
                    }
                    else
                    {
                        $total = $course_price;
                    }

                    $order_date = date("Y-m-d h:i:sa");
                    $status = "Ordered";

                    $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                    $customer_contact = mysqli_real_escape_string($conn, $_POST['contact'];)
                    $customer_email = mysqli_real_escape_string($conn, $_POST['email']);

                    $sql2 = "INSERT INTO tbl_order SET
                        course_name='$course_name',
                        course_id='$course_id',
                        price=$price,
                        total=$total,
                        equipment='$equipment',
                        order_date='$order_date',
                        status='$status',
                        customer_name='$customer_name',
                        customer_contact='$customer_contact',
                        customer_email='$customer_email'
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        $_SESSION['order'] = "<div class='success text-center'>Course reserved successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class='error'>Failed to book the course.</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>

        </div>
    </section>


<?php include('partials-front/footer.php'); ?>