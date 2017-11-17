<?php
    include_once('includes/init.php');

    $user = $_POST['username'];
    $password = hash('sha256', $_POST['password']);

    $emailOrNot = strpos($user, '@');

    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    if($emailOrNot === false){
        if(alreadyExists('user_username', $user)){
            header('Location: /?e=username');
            exit;
            //echo 'user existe';
        }else{
            $stmt = $dbh->prepare('INSERT INTO users (user_username, user_password)
                                              VALUES (?,?)');
            $stmt->execute(array($user,$password));
            currentUser('username', $user);
            header('Location: /settings.php' );
            exit;
            //echo 'user ' . $user . 'adicionado';
        }
    }else{
        if(alreadyExists('user_email', $user)){
            header('Location: /?e=email');
            exit;
            //echo 'email existe';
        }else{
            $stmt = $dbh->prepare('INSERT INTO users (user_email, user_password)
                                              VALUES (?,?)');
            $stmt->execute(array($user,$password));
            currentUser('email', $user);
            header('Location: /settings.php' );
            exit;
            //echo 'email ' . $user . ' adicionado';
        }
    }


    /* DEBUG *****
    $stmt = $dbh->prepare('SELECT * FROM users');
    $stmt->execute();

    print_r($stmt->fetchAll());
    */

?>