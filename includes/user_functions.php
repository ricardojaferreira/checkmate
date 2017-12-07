<?php
  include_once('init.php');

    function getUserData($row, $value){
        $instance = connectDB::getInstance();
        $dbh = $instance->getConnection();
        $stmt = $dbh->prepare('SELECT * FROM users
                                                WHERE '. $row .' = ?' );
        $stmt->execute(array($value));

        return $stmt->fetch();
    }

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

    function updateTableData($table, $field, $value, $user){
        $instance = connectDB::getInstance();
        $dbh = $instance->getConnection();
        $stmt = $dbh->prepare('UPDATE ' . $table . ' SET ' .
                                                    $field . '= ?' . ' WHERE
                                                     user_username' . '= ?' );
        $stmt->execute(array($value, $user));
        //return 'UPDATE ' . $table . ' SET ' .  $field . '= ?' . ' WHERE user_username' . '= ?';
    }

    function getUserValue($column, $user){
        $instance = connectDB::getInstance();
        $dbh = $instance->getConnection();
        $stmt = $dbh->prepare('SELECT ' . $column . ' FROM users ' .
                                                ' WHERE user_username' . '= ?' );
        $stmt->execute(array($user));
        return $stmt->fetch();
    }

    function createCategory($categoryName, $user){
        $userID = getUserValue('user_id', $user);
        $instance = connectDB::getInstance();
        $dbh = $instance->getConnection();
        $stmt = $dbh->prepare('INSERT INTO category (category_name, user_id) 
                                            VALUES (?,?)');
        $stmt->execute(array($categoryName, $userID['user_id']));
    }

    function getUserCategories($user){
        $userID = getUserValue('user_id', $user);
        $instance = connectDB::getInstance();
        $dbh = $instance->getConnection();
        $stmt = $dbh->prepare('SELECT category_name FROM category ' .
                                            ' WHERE user_id = ?');
        $stmt->execute(array($userID['user_id']));
        return $stmt->fetchAll();
    }
?>