<?php
    session_start();

    function setSESSION($name, $value){
        $_SESSION[$name]=$value;
    }
?>