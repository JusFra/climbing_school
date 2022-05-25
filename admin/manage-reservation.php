<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="content-2">
        <div class="data-table">
            <div class="title">
                <h2>Manage reservations</h2>
            </div>

                <?php
                    if(isset($_SESSION['no-reservation-found']))
                    {
                        echo $_SESSION['no-reservation-found'];
                        unset($_SESSION['no-reservation-found']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

                <table>
                    <tr>
                        <th>S. N.</th>
                        <th>Course name</th>
                        <th>Course id</th>
                        <th>Price</th>
                        <th>Equipment</th>
                        <th>Order date</th>
                        <th>Status</th>
                        <th>Customer name</th>
                        <th>Customer contact</th>
                        <th>Customer email</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        $sn = 1;

                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $course_name = $row['course_name'];
                                $course_id = $row['course_id'];
                                $price = $row['price'];
                                $equipment = $row['equipment'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $course_name; ?></td>
                                    <td><?php echo $course_id; ?></td>
                                    <td><?php echo round($price); ?></td>
                                    <td><?php echo $equipment; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td>
                                        <?php 
                                            if($status=="Ordered")
                                            {
                                                echo "<label>$status</label>";
                                            }
                                            elseif($status=="Confirmed")
                                            {
                                                echo "<label style='color: orange;'>$status</label>";
                                            }
                                            elseif($status=="Finished")
                                            {
                                                echo "<label style='color: #58c67b;'>$status</label>";
                                            }
                                            else
                                            {
                                                echo "<label style='color: #B80C09;'>$status</label>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>

                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-reservation.php?id=<?php echo $id; ?>" class="btn btn-secondary">Update</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            ?>
                                <tr>
                                    <td colspan="8"><div class="error">No reservations added.</div></td>
                                </tr>
                            <?php
                        }
                    ?>
                </table>

            </div>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>