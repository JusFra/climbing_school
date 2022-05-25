<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="content-2">
        <div class="form-table">
            <div class="title">
                <h2>Update reservation</h2>
            </div>

        <?php

            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $course_name = $row['course_name'];
                    $course_id = $row['course_id'];
                    $price = $row['price'];
                    $equipment = $row['equipment'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                }
                else
                {
                    $_SESSION['no-reservation-found'] = "<div class='error'>Reservation not found.</div>";
                    header('location:'.SITEURL.'admin/manage-reservation.php');
                }
                
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }  
        ?>

        <form action="" method="POST">

            <table>
                <tr>
                    <td>Customer name: </td>
                    <td><?php echo $customer_name; ?></td>
                </tr>
                <tr>
                    <td>Customer contact: </td>
                    <td><?php echo $customer_contact; ?></td>
                </tr>
                <tr>
                    <td>Customer email: </td>
                    <td><?php echo $customer_email; ?></td>
                </tr>
                <tr>
                    <td>Course name: </td>
                    <td><b><?php echo $course_name; ?></b></td>
                </tr>
                <tr>
                    <td>Course date: </td>

                    <?php
                        $sql2 = "SELECT date_start, date_end FROM tbl_course WHERE id=$course_id";
                        $res2 = mysqli_query($conn, $sql2);
                        if($res2==true)
                        {
                            $row2 = mysqli_fetch_assoc($res2);
                            $course_start = $row2['date_start'];
                            $course_end = $row2['date_end'];
                            ?>
                            <td><?php echo $course_start; ?> - <?php echo $course_end; ?></td>
                            <?php
                        }
                        else
                        {
                            ?>
                            <td class="error">Error</td>
                            <?php
                        }
                    ?>

                    
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><?php echo round($price); ?> zł</td>
                </tr>
                <tr>
                    <td>Equipment: </td>
                    <td><?php echo $equipment; ?></td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status" class="input-field">
                            <option <?php if($status=="Ordered"){ echo "selected"; } ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="Confirmed"){ echo "selected"; } ?> value="Confirmed">Confirmed</option>
                            <option <?php if($status=="Cancelled"){ echo "selected"; } ?> value="Cancelled">Cancelled</option>
                            <option <?php if($status=="Finished"){ echo "selected"; } ?> value="Finished">Finished</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Course" class="input-field btn btn-primary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $status = $_POST['status'];

                $sql3 = "UPDATE tbl_order SET
                    status='$status'
                    WHERE id=$id
                ";

                $res3 = mysqli_query($conn, $sql3);

                if($res3==true)
                {
                    $_SESSION['update'] = "<div class='success'>Status of reservation updated successfully.</div>";
                    header('location:'.SITEURL.'/admin/manage-reservation.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to update status of reservation.</div>";
                    header('location:'.SITEURL.'/admin/manage-reservation.php');
                }
            }
        ?>
        </div>
    </div>
</div>


<?php include('partials/footer.php'); ?>