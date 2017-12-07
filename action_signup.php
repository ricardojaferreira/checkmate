<?php
    include_once('includes/init.php');

    if(!isset($_POST['username']) || !isset($_POST['password']) || $_POST['username']=='' || $_POST['password']==''){
        setSESSION('signupError','Something is missing!');
        header('Location: /index.php');
        exit;
    }

    $user = $_POST['username'];

    /*** VERIFY Password ****/
    $ruleTwo="/[0-9]+/";
    $ruleThreeCapital="/[A-Z]+/";
    $ruleThreeSmall="/[a-z]+/";
    $ruleFour="/[.!@#$%^&*()?_\/+\"\'=-]+/";

    if(strlen($_POST['password'])>=8 &&
        preg_match($ruleTwo, $_POST['password'])!=False &&
        preg_match($ruleThreeCapital, $_POST['password'])!=False &&
        preg_match($ruleThreeSmall, $_POST['password'])!=False &&
        preg_match($ruleFour, $_POST['password'])!=False){

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    }else{
        setSESSION('signupError','Your password has problems!');
        header('Location: /index.php');
        exit;
    }





    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $emailOrNot = strpos($user, '@');

    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    if($emailOrNot === false){
        if(alreadyExists('user_username', $user)){
            setSESSION('signupError','The username entered already exists!');
            header('Location: /index.php');
            exit;
            //echo 'user existe';
        }else{
            $stmt = $dbh->prepare('INSERT INTO users (user_username, user_password)
                                              VALUES (?,?)');
            $stmt->execute(array($user,$password));
            createCategory('Default',$user);
            setSESSION('username', $user);
            header('Location: /settings.php' );
            exit;
            //echo 'user ' . $user . 'adicionado';
        }
    }else{
        if(alreadyExists('user_email', $user)){
            setSESSION('signupError','The email entered already exists!');
            header('Location: /index.php');
            exit;
            //echo 'email existe';
        }else{
            $newUserName = substr($user, 0, $emailOrNot);
            if(getUserData('user_username', $newUserName)) {
                setSESSION('signupError','Please use a different email!');
                header('Location: /index.php');
                exit;
            }else {
                $stmt = $dbh->prepare('INSERT INTO users (user_username, user_email, user_password)
                                                  VALUES (?, ?,?)');
                $stmt->execute(array($newUserName, $user, $password));
                createCategory('Default',$newUserName);
                setSESSION('username', $newUserName);
                header('Location: /settings.php');
                exit;
                //echo 'email ' . $user . ' adicionado';
            }
        }
    }


    /* DEBUG *****
    $stmt = $dbh->prepare('SELECT * FROM users');
    $stmt->execute();

    print_r($stmt->fetchAll());
    */

?>