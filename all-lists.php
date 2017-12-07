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
          //var checkbox = document.getElementById("changeListName");
          var hideCreate = document.getElementById("changeName");

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

        function changePage(elm){
            window.location = elm.value;
        }
    </script>

</head>
<body>

  <?php

    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    try {
      $stmt = $dbh->prepare("SELECT * FROM category JOIN users USING(user_id) WHERE user_username= ?");
      $stmt->execute(array($_SESSION['username']));
      $categories = $stmt->fetchAll();

    }catch (PDOException $e) {
      echo $e->getMessage();
    }



  ?>

<header>
    <img src="images/logo-check-mate.png" alt="Logo" width="188" height="71">
    <select onchange = "changePage(this)" name="gotolist" id="gotolist">
        <option value="all-lists.php" id="default">All Lists</option>
        <?php foreach( $categories as $category) { ?>
          <option  value="todos.php?category_id=<?=$category['category_id']?>" id="list1"><?=$category['category_name']?></option></a>

        <?php } ?>
    </select>
    <a class='log-out'href="index.php">Log Out</a>
    <a class='search' href="#">
        <i class="fa fa-search" aria-hidden="true"></i>
    </a>
    <a class='settings' href="#">
        <i class="fa fa-cog" aria-hidden="true"></i>
    </a>
</header>

<!-- <div class="container"> -->

<section id="all-lists">
    <h1>All Lists</h1>

    <select name="sortby" id="sortby">
        <option value="defaultsort" id="defaultsort">Sort By</option>
        <option value="name" id="name">Title</option>
    </select>
    <br>
    <a class='trash' onclick = "showHide()">
        <i class="fa fa-plus" aria-hidden="true"></i>
    </a>

    <div id="createCategory">
      <div id="flexCategory">
        <form action="action_createCategory.php" method="post">
            <label class='categoryName'>List Title:</label>
            <input type="text" name="categoryName" required="required" id="categoryName">
            <input type="submit" value="Create Category">
        </form>
      </div>
    </div>
    <br>

    <?php foreach( $categories as $category) { ?>

    <article>

        <a  id= "categoryHeader" href="todos.php?category_id=<?=$category['category_id']?>"><h2><?=$category['category_name']?></h2></a>
        <a class='trash' href="action_removeCategory.php?category_id=<?=$category['category_id']?>">
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
