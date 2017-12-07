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
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

  <?php include_once('includes/init.php');

    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    $todo_id = $_GET['todo_id'];


    $query = "SELECT * FROM todo WHERE todo_id = $todo_id";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $this_todo = $stmt->fetchAll();


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

    <h1><a class='back' href="todos.php?category_id=<?=$_SESSION['category_id']?>"><i class="fa fa-chevron-left" aria-hidden="true"></i></a><?=$this_todo[0]['todo_description']?></h1>

    <div id="todoForm">

      <form action="action_updateTodo.php?todo_id=<?=$todo_id?>" method="post">

          <br><label class='todoDescript'>Description:</label>
          <input type="text" name="todoDescript" placeholder="<?=$this_todo[0]['todo_description']?>"  id="todoDescript">
          <br><label class='todoDescript'>Deadline:</label>
          <input type="date"  name="deadline"  placeholder="<?=$this_todo[0]['todo_deadline']?>" id="deadline">
          <br><label class='todoDescript'>State:</label>
          <input type="text" name="state"  placeholder="<?=$this_todo[0]['todo_percentage']?>" id="deadline">
          <br><input type="submit" value="Save Changes">
      </form>
    </div>

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
