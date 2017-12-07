<?php if(isset($_SESSION['username'])){ ?>
    <section id="log-in">
        <h3>Hello <?=$_SESSION['username']?>!</h3>
        <p>You are already Logged In, don't you remember?</p>
        <br/>
        <br/>
        <p>Here is a nice link about <a class="remember" href="https://en.wikipedia.org/wiki/Alzheimer%27s_disease" target="_blank">alzeimer</a>!</p>
    </section>
<?php }else{?>
    <section id="log-in">
        <h2>Please Log In</h2>
        <form action="action_login.php" method="post">
            <!-- <label for="username"></label> -->
            <input type="text" name="logusername" placeholder="username" id="username" required="required"><span class="fa fa-check usercheck" aria-hidden="true"></span><i class="fa fa-times usernotcheck" aria-hidden="true"></i><br>
            <ul class="checkuser">
                <li></li>
            </ul>
            <!-- <label for="password"></label> -->
            <input type="password" name="logpassword" placeholder="password" id="password" required="required"><span class="fa fa-check passcheck" aria-hidden="true"></span><i class="fa fa-times passnotcheck" aria-hidden="true"></i><br>
            <input type="submit" value="Log In">
        </form>
        <p class="<?if(isset($_SESSION['signupError'])){echo 'error-show';}else{echo 'error-hide';}?>"><?echo $_SESSION['signupError']; ?><p>
    </section>
<?php }?>
<?php

if(isset($_SESSION['signupError'])){
    unset($_SESSION['signupError']);
}

?>