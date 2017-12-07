<?php
    session_start();

    function setSESSION($name, $value){
        $_SESSION[$name]=$value;
    }

    function currentCategory($type, $value){
        $_SESSION[$type]=$value;
    }
?>