<?php
    include_once('includes/db_connection.php');
    include_once('includes/init.php');
    include_once('includes/setData.php');

    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    $category_name = $_POST['categoryName'];

    try {
      $stmt = $dbh->prepare("SELECT user_id FROM users WHERE user_username = ?");
      $stmt->execute(array($_SESSION['username']));
      $result = $stmt->fetchAll();
    }catch (PDOException $e) {
      echo $e->getMessage();
    }

    $username_id = $result[0]['user_id'];

    setCategory($category_name,$username_id);
    header('Location: all-lists.php' );
    exit;
?>
