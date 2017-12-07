<?php

  function setCategory($category_name,$username_id){
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO category VALUES (NULL, ?, ? )');
    $stmt->execute(array($category_name,$username_id));
  }

  function setTodo($todo_description,$lastUpdate,$deadline,$percentage,$category_id){
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO todo VALUES (NULL, ?, ?, ?, ?, ?)');
    $stmt->execute(array($todo_description,$lastUpdate,$deadline,$percentage,$category_id));
  }

  function changeList($list_name,$oldName,$username_id){
    global $dbh;
    $stmt = $dbh->prepare('UPDATE category SET category_name = ? WHERE category_name = ? AND user_id = ?');
    $stmt->execute(array($list_name,$oldName,$username_id));
  }

?>
