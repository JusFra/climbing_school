<?php

    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name!="")
        {
            $path = "../images/courses/".$image_name;
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove'] = "Failed to remove course image.";
                header('location:'.SITEURL.'admin/manage-course.php');
                die();
            }
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-course.php');
    }


    $sql = "DELETE FROM tbl_course WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res)
    {
        $_SESSION['delete'] = "<div class='success'>Course deleted successfully.</div>";
        header('location:'.SITEURL.'admin/manage-course.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to delete course.</div>";
        header('location:'.SITEURL.'admin/manage-course.php');
    }

?>