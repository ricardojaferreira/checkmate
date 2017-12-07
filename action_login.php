<?php
    include_once('includes/init.php');

    if(!isset($_POST['logusername']) || !isset($_POST['logpassword']) || $_POST['logusername']=='' || $_POST['logpassword']==''){
        setSESSION('signupError','Something is missing!');
        header('Location: /login.php');
        exit;
    }

    $user = $_POST['logusername'];
    $password = $_POST['logpassword'];

    if(!alreadyExists('user_username', $user)){
        setSESSION('signupError','The username entered is not valid!');
        header('Location: /login.php');
        exit;
    }else{
        $databasePass = getUserValue('user_password', $user);
        if(password_verify($_POST['logpassword'], $databasePass['user_password'])){
            setSESSION('username', $user);
            header('Location: /settings.php' );
            exit;
        }else{
            setSESSION('signupError','The passwords dont match!');
            header('Location: /login.php');
            exit;
        }

    }
?>