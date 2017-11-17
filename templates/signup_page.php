<section id="app-promo">
    <div class="promo-slogans">
        <h1>Organize your day one To Do at a time</h1>
        <h1 class="hidden-slogan">Simplify your tasks.</h1>
        <h1 class="hidden-slogan">Make your routines funny.</h1>
    </div>
    <p>Create and organize your to do's from anywhere in the world.</p>
</section>

<div class="wrapper-divider">
    <div class="divider"></div>
</div>

<section id="sign-up">
    <h2>Sign Up for Free</h2>
    <form action="action_signup.php" method="post">
        <!-- <label for="username"></label> -->
        <input type="text" name="username" placeholder="username or email" id="username" required="required"><span class="fa fa-check usercheck" aria-hidden="true"></span><i class="fa fa-times usernotcheck" aria-hidden="true"></i><br>
        <ul class="checkuser">
            <li></li>
        </ul>
        <!-- <label for="password"></label> -->
        <input type="password" name="password" placeholder="password" id="password" required="required"><span class="fa fa-check passcheck" aria-hidden="true"></span><i class="fa fa-times passnotcheck" aria-hidden="true"></i><br>
        <div class="checkpassword">
            <h4>Your password must have:</h4>
            <ul>
                <li class="first-rule">At least 8 characters <span class="fa fa-check" aria-hidden="true"></span></li>
                <li class="second-rule">At least 1 number <span class="fa fa-check" aria-hidden="true"></span></li>
                <li class="third-rule">At least 1 capital and 1 small letter <span class="fa fa-check" aria-hidden="true"></span></li>
                <li class="forth-rule">At least 1 special character <span class="fa fa-check" aria-hidden="true"></span></li>
            </ul>
        </div>
        <input type="submit" value="Sign Up">
    </form>
    <p class="<?if(isset($_GET[e])){echo 'error-show';}else{echo 'error-hide';}?>">The <?echo $_GET[e]; ?> entered already exists!<p>
</section>