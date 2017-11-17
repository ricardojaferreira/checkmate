<?php
    session_start();

    function currentUser($type, $value){
        $_SESSION[$type]=$value;
    }
?>