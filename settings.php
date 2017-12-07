<?php
    include_once('includes/init.php');
    if(isset($_SESSION['username'])){
        include_once('templates/head.php');
        include_once('templates/header.php');
        include_once('templates/user_settings.php');
        include_once('templates/footer.php');
    }else{
        echo 'you can not access this page without a session';
    }
?>