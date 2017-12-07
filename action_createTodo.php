<?php
    include_once('includes/db_connection.php');
    include_once('includes/init.php');
    include_once('includes/setData.php');

    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    $todo_description = $_POST['todoDescript'];
    $lastUpdate = date('Y-m-d H:i:s');
    $deadline = $_POST['deadline'];
    $percentage = $_POST['state'];
    $category_id = $_SESSION['category_id'];
    setTodo($todo_description,$lastUpdate,$deadline,$percentage,$category_id);

    header('Location: todos.php?category_id='.$category_id);
    exit;
?>
