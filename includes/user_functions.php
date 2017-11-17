<?php
  include_once('init.php');

    function alreadyExists($row, $value){
        $instance = connectDB::getInstance();
        $dbh = $instance->getConnection();
        $stmt = $dbh->prepare('SELECT * FROM users
                                                WHERE '. $row .' = ?' );
        $stmt->execute(array($value));

        return $stmt->fetch() !== false;
    }

    function isSignInCorrect($row,$user,$password){
        echo 'hello';
    }

?>