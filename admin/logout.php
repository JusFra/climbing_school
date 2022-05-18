<?php

    include('../config/constants.php');

    //Destroy the session
    session_destroy();

    header('location:'.SITEURL.'admin/login.php');
    
?>