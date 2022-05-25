<?php include('partials/menu.php'); ?>

<div class="content">
    <div class="content-2">
        <div class="data-table">
            <div class="title">
                <h2>Manage admin</h2>
                <a href="<?php echo SITEURL; ?>admin/add-admin.php" class="btn">Add Admin</a>
            </div>

            <br><br>

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?>


            <table>
                <tr>
                    <th>S. N.</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>License Number</th>
                    <th>Valid</th>
                    <th>Actions</th>
                </tr>
                    
                    <?php
                        $sql = "SELECT * FROM tbl_admin";
                        $res = mysqli_query($conn, $sql);

                        if($res==TRUE)
                        {
                            $count = mysqli_num_rows($res);

                            $sn=1;

                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id = $rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];
                                    $license=$rows['license'];
                                    $valid=$rows['valid'];

                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td><?php echo $license; ?></td>
                                        <td><?php echo $valid; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn btn-primary">Change password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete Admin</a>
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

<?php include('partials/footer.php'); ?>