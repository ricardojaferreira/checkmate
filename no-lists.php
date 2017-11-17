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
<body class="onecolumn">

<header>
    <img src="images/logo-check-mate.png" alt="Logo" width="188" height="71">
    <a class='log-out'href="index.php">Log Out</a>
    <!-- <a class='search' href="#">
        <i class="fa fa-search" aria-hidden="true"></i>
    </a> NOTA: Ainda não existem listas!-->
    <a class='settings' href="#">
        <i class="fa fa-cog" aria-hidden="true"></i>
    </a>
</header>

<!-- <div class="container"> -->

<section id="nolists">
    <h1>You have no lists yet!</h1>
    <a class='start' href="all-lists.html">Start Here</a>
</section>




<!-- </div> -->

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