<?php
    include_once('includes/init.php');

    $result = getUserValue($_POST['value'], $_SESSION['username']);
    echo json_encode($result);
?>