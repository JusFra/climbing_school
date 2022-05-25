<?php include('partials/menu.php'); ?>

        <br><br>
        <div class="content">

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>


            <div class="cards">
                <div class="card">
                    <div class="box">

                    <?php
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                    ?>

                        <h1><?php echo $count; ?></h1>
                        <h3>Categories</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../images/list.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">

                    <?php
                        $sql2 = "SELECT * FROM tbl_course";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                    ?>

                        <h1><?php echo $count2; ?></h1>
                        <h3>Courses</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../images/climber.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">

                    <?php
                        $sql3 = "SELECT * FROM tbl_order";
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>

                        <h1><?php echo $count3; ?></h1>
                        <h3>Reservations</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../images/appointment.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">

                    <?php
                        $sql4 = "SELECT SUM(total) AS total FROM tbl_order WHERE status='Finished'";
                        $res4 = mysqli_query($conn, $sql4);
                        $row4 = mysqli_fetch_assoc($res4);
                        $total_revenue = $row4['total'];
                    ?>

                        <h1><?php echo round($total_revenue); ?> zł</h1>
                        <h3>Income</h3>
                    </div>
                    <div class="icon-case">
                        <img src="../images/income.png" alt="">
                    </div>
                </div>
            </div>

            <div class="content-2">
                <div class="recent-reservations">
                    <div class="title">
                        <h2>Recent Reservations</h2>
                        <a href="manage-reservation.php" class="btn">View All</a>
                    </div>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>

                        <?php
                            $sql = "SELECT * FROM tbl_order ORDER BY id DESC LIMIT 6";
                            $res = mysqli_query($conn, $sql);

                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $course_name = $row['course_name'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                ?>
                                <tr>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $course_name; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><a href="<?php echo SITEURL; ?>admin/update-reservation.php?id=<?php echo $id; ?>" class="btn">View</a></td>
                                </tr>
                                <?php
                            }

                        ?>
 
                    </table>
                </div>
                <div class="next-courses">
                    <div class="title">
                        <h2>Next Courses</h2>
                        <a href="manage-course.php" class="btn">View All</a>
                    </div>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                        </tr>

                        <?php
                            $sql2 = "SELECT * FROM tbl_course ORDER BY date_start LIMIT 6";
                            $res2 = mysqli_query($conn, $sql2);

                            while($row2=mysqli_fetch_assoc($res2))
                            {
                                $id = $row2['id'];
                                $title = $row2['title'];
                                $date_start = DateTime::createFromFormat('Y-m-d', $row2['date_start']);
                                $date_end = DateTime::createFromFormat('Y-m-d', $row2['date_end']);
                                ?>
                                <tr>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo date_format($date_start, 'd.m'); ?> - <?php echo date_format($date_end, 'd.m'); ?></td>
                                    
                                </tr>
                                <?php
                            }

                        ?>

                        
                    </table>
                </div>
        </div>
    </div>
</body>
</html>