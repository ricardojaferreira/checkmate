<?php
    include_once('includes/init.php');

    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    $id = $_GET['todo_id'];
    $query = "DELETE FROM todo WHERE todo_id = $id";
    $stmt = $dbh->prepare($query);
    $stmt->execute();

    header('Location: todos.php?category_id='.$_SESSION['category_id']);
    exit;
?>
