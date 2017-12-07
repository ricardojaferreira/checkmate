<?php
    include_once('includes/db_connection.php');
    include_once('includes/init.php');
    include_once('includes/setData.php');

    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    $category_name = $_GET['category_name'];
    $list_name = $_POST['categoryName'];

    try {
      $stmt = $dbh->prepare("SELECT * FROM users WHERE user_username= ?");
      $stmt->execute(array($_SESSION['username']));
      $result = $stmt->fetchAll();
      print_r($result);

    }catch (PDOException $e) {
      echo $e->getMessage();
    }
    $user_id = $result[0]['user_id'];
    changeList($list_name,$category_name, $user_id);
    header('Location: todos.php?category_id='.$_SESSION['category_id']);
    exit;
?>
