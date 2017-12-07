<?php
    include_once('includes/init.php');

    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    $id = $_GET['category_id'];

    $query = "SELECT * FROM todo JOIN category USING(category_id) WHERE category_id = $id";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $todos = $stmt->fetchAll();

    foreach( $todos as $todo) {
      $query = "DELETE FROM todo WHERE todo_id =".$todo['todo_id'];
      $stmt = $dbh->prepare($query);
      $stmt->execute();
    }

    $query = "DELETE FROM category WHERE category_id = $id";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    header('Location: all-lists.php' );
    exit;
?>
