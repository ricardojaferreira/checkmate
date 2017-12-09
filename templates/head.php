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
    <link rel="stylesheet" href="styles/font-awesome.min.css">
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/main.css">
    <?php if(isset($_SESSION['username'])){?>
        <link rel="stylesheet" href="styles/search.css">
        <script src="js/search.js" defer></script>
    <?php }?>
    <?php if(strpos($_SERVER['PHP_SELF'],'/index.php')!==false){?>
        <script src="js/homepage.js" defer></script>
    <?php }?>
    <?php if(strpos($_SERVER['PHP_SELF'],'/settings.php')!==false){?>
        <script src="js/settings.js" defer></script>
    <?php }?>
    <?php if(isset($_SESSION['username'])){?>
        <script src="js/selects.js" defer></script>
    <?php }?>
</head>
<body>