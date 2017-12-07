<?php include_once('includes/init.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CheckMate</title>
    <meta name="application-name" content="Check Mate">
    <meta name="description" content="An application to manage To Do's">
    <meta name="author" content="Filipe Lemos, Ricardo Ferreira">
    <meta name="keywords" content="ToDo, Management, Organization, Categories">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript">
        function showHide(){
          //var checkbox = document.getElementById("addCategory");
          var hideCreate = document.getElementById("createCategory");

          /*if(checkbox.checked){
            hideCreate.style.display = "block";
          }
          else {
            hideCreate.style.display = "none";
          }*/

          if(hideCreate.style.display=='none'){
            hideCreate.style.display = "block";
          }
          else{
            hideCreate.style.display = "none";
          }
        }

        function showHideChange(){

          var hideCreate = document.getElementById("changeName");

          /*if(checkbox.checked){
            hideCreate.style.display = "block";
          }
          else {
            hideCreate.style.display = "none";
          }*/

          if(hideCreate.style.display=="none"){
            hideCreate.style.display = "block";
          }
          else{
            hideCreate.style.display = "none";
          }
        }


        function changePage(elm){
            window.location = elm.value;
        }
    </script>

</head>
<body>

  <?php

    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    $id = $_GET['category_id'];
    currentCategory('category_id', $id);

    $query = "SELECT * FROM todo JOIN category USING(category_id) WHERE category_id = $id";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $todos = $stmt->fetchAll();

    $query = "SELECT * FROM category WHERE category_id = $id";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $name = $stmt->fetchAll();

    try {
      $stmt = $dbh->prepare("SELECT * FROM category JOIN users USING(user_id) WHERE user_username= ? and category_id<> ?");
      $stmt->execute(array($_SESSION['username'],$id));
      $categories = $stmt->fetchAll();

    }catch (PDOException $e) {
      echo $e->getMessage();
    }

  ?>

<header>
    <img src="images/logo-check-mate.png" alt="Logo" width="188" height="71">
    <select onchange = "changePage(this)" name="gotolist" id="gotolist">
        <option value="#" id="default"><?=$name[0]['category_name']?></option>
        <option value="all-lists.php" id="default">All lists</option>
        <?php foreach( $categories as $category) { ?>
          <option  value="todos.php?category_id=<?=$category['category_id']?>" id="list1"><?=$category['category_name']?></option></a>
        <?php } ?>
    </select>
    <a class='log-out'href="index.php">Log Out</a>
    <a class='search' href="#">
        <i class="fa fa-search" aria-hidden="true"></i>
    </a>
    <a class='settings' href="/settings.php">
        <i class="fa fa-cog" aria-hidden="true"></i>
    </a>
</header>

<!-- <div class="container"> -->



<section id="all-lists">

    <h1><a class='back' href="all-lists.php"><i class="fa fa-chevron-left" aria-hidden="true"></i></a><a onclick = "showHideChange()" ><i class="fa fa-pencil" aria-hidden="true"></i></a><?=$name[0]['category_name']?></h1>
    <div id="changeName">
      <div id="flexCategory">
        <form action="action_changeList.php?category_name=<?=$name[0]['category_name']?>" method="post">
            <label class='categoryName'>Change Title:</label>
            <input type="text" name="categoryName" placeholder="<?=$name[0]['category_name']?>" required="required" id="categoryName">
            <input type="submit" value="Save Changes">
        </form>
      </div>
    </div>
    <br>

    <select name="sortby" id="sortby">
        <option value="defaultsort" id="defaultsort">Sort By</option>
        <option value="name" id="name">Name</option>
        <option value="deadline" id="deadline">Deadline</option>
        <option value="priority" id="priority">Priority</option>
    </select>
    <br>

    <a class='trash' onclick = "showHide()">
        <i class="fa fa-plus" aria-hidden="true"></i>
    </a>

    <div id="createCategory">
      <div id="flexCategory">
        <form action="action_createTodo.php?category_id=<?=$id?>" method="post">
            <label class='todoDescript'>Description:</label>
            <input type="text" name="todoDescript" required="required" id="todoDescript">
            <label class='todoDescript'>Deadline:</label>
            <input type="date"  name="deadline"  id="deadline">
            <label class='todoDescript'>State:</label>
            <input type="text" name="state"  id="state">
            <input type="submit" value="Add todo">
        </form>
      </div>
    </div>
    <br>

    <?php foreach( $todos as $todo) { ?>
    <article>
        <a class='pencil' href="changeTodo.php?todo_id=<?=$todo['todo_id']?>">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>
        <h2><?=$todo['todo_description']?></h2>
        <p><?=$todo['todo_lastUpdate']?></p>
        <p><?=$todo['todo_deadline']?></p>
        <p><?=$todo['todo_percentage']?></p>
        <a class='trash' href="action_removeTodo.php?todo_id=<?=$todo['todo_id']?>">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
        </a>
    </article>
    <br>
    <?php } ?>

</section>

<footer>
    <p>&copy; 2017 All rights reserved</p>
    <div class="choose-lang">
        <label for="country">Choose a language: </label>
        <select name="country" id="country">
            <option value="eng" id="eng">English (GB)</option>
            <option value="pt" id="pt">Portuguese</option>
            <option value="esp" id="esp">Spanish</option>
            <option value="ita" id="ita">Italian</option>
            <option value="ger" id="ger">German</option>
        </select>
    </div>
</footer>

</body>
</html>
