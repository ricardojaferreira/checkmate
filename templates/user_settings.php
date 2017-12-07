<?php
    if(isset($_SESSION['username'])){
        $userDetails = getUserData('user_username', $_SESSION['username']);
    }
?>
<div id="modal" class="modal-messages">
    <div>
        <h2>Saved ... 😀</h2>
    </div>
</div>
<div class="wrapper-user-settings">
<div id="user-settings">
    <h2>Your Profile</h2>

    <section id="userDetails">

        <div class="profilePicZone">
            <div class="dragBox">
                <strong>Drop Photo</strong>
            </div>
            <img class="profilePic" src="<?php if($userDetails['user_profilepic']!=''){echo $userDetails['user_profilepic'];}else{echo 'images/default_avatar.jpeg';}?>" alt="default_avatar" width="200" height="200">
        </div>

        <h5 class="user_name"><?=$userDetails['user_name']?></h5>
        <p class="user_username"><?=$userDetails['user_username']?></p>
        <p class="user_description"><?=$userDetails['user_description']?></p>
        <p class="userMail">
            <a href="mailto:johndoe@john.com"><span class="user_email"><?=$userDetails['user_email']?></span> <i class="fa fa-envelope" aria-hidden="true"></i></a>
        </p>
        <p class="userPhone">
            <a href="tel:916151565"><span class="user_phone"><?=$userDetails['user_phone']?></span> <i class="fa fa-phone-square" aria-hidden="true"></i></a>
        </p>
        <p class="userAddress">
            <span class="user_address"><?=$userDetails['user_address']?></span> <i class="fa fa-map-marker" aria-hidden="true"></i>
        </p>

    </section>

    <section id="setDetails">
            <label for="Name" class='user_name settingsHeaders' id="nameLabel">Name:</label>
            <input type="text" name="Name"  id="user_name" class="formUserInputs">

            <label for="Username" class='user_username settingsHeaders'>Username:</label>
            <input type="text" name="Username"  id="user_username" class="formUserInputs">

            <label for="Email" class='user_email settingsHeaders'>Email:</label>
            <input type="text" name="Email"  id="user_email" class="formUserInputs">

            <label for="Phone" class='user_phone settingsHeaders'>Phone:</label>
            <input type="text" name="Phone" id="user_phone" class="formUserInputs">

            <label for="Address" class='user_address settingsHeaders'>Address:</label>
            <input type="text" name="Address" id="user_address" class="formUserInputs">

            <label for="Bio" class='user_description settingsHeaders'>Bio:</label>
            <textarea rows="4" cols="50" name="Bio" placeholder="Tell us something about yourself" id="user_description" class="formUserInputs"></textarea>

            <label for="currentPassword" class='currentPassword settingsHeaders'>Change your password:</label>
            <input type="password" name="currentPassword" placeholder="Current password" id="currentPassword">

            <!--<label for="newPassword" class='settingsHeaders'>New password:</label>-->
            <input type="password" name="newPassword"  placeholder="New Password" id="newPassword">
            <div class="checkpassword">
                <h4>Your password must have:</h4>
                <ul>
                    <li class="first-rule">At least 8 characters <span class="fa fa-check" aria-hidden="true"></span></li>
                    <li class="second-rule">At least 1 number <span class="fa fa-check" aria-hidden="true"></span></li>
                    <li class="third-rule">At least 1 capital and 1 small letter <span class="fa fa-check" aria-hidden="true"></span></li>
                    <li class="forth-rule">At least 1 special character <span class="fa fa-check" aria-hidden="true"></span></li>
                </ul>
            </div>
<!--
            <label for="newConfirmedPassword" class='settingsHeaders'>Confirm new password:</label>
            <input type="password" name="newConfirmedPassword" id="newConfirmedPassword">
-->
        <button class="saveChanges">Save Changes</button>
    </section>
</div>
</div>