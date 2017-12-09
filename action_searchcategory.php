<?php
    include_once('includes/init.php');

    $search = $_POST['searchWord'];
    $searchResult = searchCategory($_SESSION['username'],$search);
    echo json_encode($searchResult);

?>