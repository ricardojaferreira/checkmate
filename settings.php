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
</head>
<body>

    <header>
        <img src="images/logo-check-mate.png" alt="Logo" width="188" height="71">
        <select name="gotolist" id="gotolist">
            <option value="default" id="default">Go to List</option>
            <option value="list1" id="list1">List 1</option>
            <option value="list2" id="list2">List</option>
        </select>
        <a class='log-out'href="index.html">Log Out</a>
        <a class='search' href="#">
            <i class="fa fa-search" aria-hidden="true"></i>
        </a>
    </header>

   <!-- <div class="container"> -->

    <div id="user-settings">
        <h2>Your Profile</h2>

        <section id="profilepic">
            <img src="images/profile_pics/default_avatar.jpeg" alt="default_avatar" width="200" height="200">
            <button>Upload Photo</button>
        </section>

        <section id="settings">
            <form>
                <label class='settingsHeaders'>Name:</label><br>
                <input type="text" name="name"  id="name"><br>
                <label class='settingsHeaders'>Would you like to change your username?</label><br>
                <input type="text" name="username"  id="changeUsername"><br>
                <label class='settingsHeaders'>Would you like to change your Password?</label><br>
                <input type="password" name="currentPassword" placeholder="current password" id="currentPassword"><br>
                <label class='settingsHeaders'>New password:</label><br>
                <input type="password" name="newPassword"  id="newPassword"><br>
                <label class='settingsHeaders'>Confirm new password:</label><br>
                <input type="password" name="newConfirmedPassword" id="newConfirmedPassword"><br>
                <label class='settingsHeaders'>Bio</label><br>
                <textarea rows="4" cols="50" placeholder="Tell us something about yourself" id="bio"></textarea><br>
                <label class='settingsHeaders'>Mobile phone:</label><br>
                <input type="text" name="phone" id="phone"><br>
                <label class='settingsHeaders'>Address:</label><br>
                <input type="text" name="address" id="address"><br>
                <input type="submit" value="Save Changes">
            </form>
        </section>
    </div>

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

    <script src="js/homepage.js"></script>

</body>
</html>
