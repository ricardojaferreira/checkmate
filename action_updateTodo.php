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
    $todo_id = $_GET['todo_id'];

    try {
      $stmt = $dbh->prepare("SELECT * FROM todo WHERE todo_id= ?");
      $stmt->execute(array($todo_id));
      $result = $stmt->fetchAll();

    }catch (PDOException $e) {
      echo $e->getMessage();
    }

    if(strcmp($todo_description,"")==0 && strcmp($result[0]['todo_description'],"")!=0)
      $todo_description=$result[0]['todo_description'];
    if(strcmp($deadline,"")==0 && strcmp($result[0]['todo_dealine'],"")!=0)
      $deadline=$result[0]['todo_deadline'];
    if(strcmp($percentage,"")==0 && strcmp($result[0]['todo_percentage'],"")!=0)
      $percentage=$result[0]['todo_percentage'];

    changeTodo($todo_description,$lastUpdate,$deadline,$percentage,$todo_id);
    header('Location: todos.php?category_id='.$category_id);
    exit;
?>
