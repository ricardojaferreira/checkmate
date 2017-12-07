<?php
    include_once('includes/init.php');

    $userDetails = $_POST['userDetails'];
    $userPasswords = $_POST['userPasswords'];

    $userDetailsObj = json_decode($userDetails,true);
    $picture = $_POST['userPicture'];
    $userPasswordsObj = json_decode($userPasswords,true);

    $ruleTwo="/[0-9]+/";
    $ruleThreeCapital="/[A-Z]+/";
    $ruleThreeSmall="/[a-z]+/";
    $ruleFour="/[.!@#$%^&*()?_\/+\"\'=-]+/";

    $resultArray = ['error' => 'No error'];

    foreach($userDetailsObj as $key => $value){
        if($value!=''){
            updateTableData('users', $key, $value, $_SESSION['username']);
            if($key == 'user_username'){
                $_SESSION['username']=$value;
            }
        }
    }

    if(strpos($picture,'data')===0){
        $instance = connectDB::getInstance();
        $dbh = $instance->getConnection();
        $stmt = $dbh->prepare('SELECT user_id FROM users');
        $stmt->execute();
        $result=$stmt->fetchAll();

        $resultplusone = count($result)+1;
        $profilePicFileName = 'images/profile/user'. "_{$resultplusone}.jpg";

        $userPicture_exploded=explode(',', $picture);
        $pictureNoSpaces = str_replace(' ', '+',$userPicture_exploded[1]);

        $imagedecoded = base64_decode($pictureNoSpaces);
        file_put_contents($profilePicFileName, $imagedecoded);
        updateTableData('users', 'user_profilepic', $profilePicFileName, $_SESSION['username']);
        $resultArray['imgsrc']=$profilePicFileName;
    }


    if($userPasswordsObj['user_currentPassword']!='' && $userPasswordsObj['user_password']!=''){
        $tempPassword=$userPasswordsObj['user_password'];
        if(strlen($tempPassword)>=8 &&
            preg_match($ruleTwo, $tempPassword)!=False &&
            preg_match($ruleThreeCapital, $tempPassword)!=False &&
            preg_match($ruleThreeSmall, $tempPassword)!=False &&
            preg_match($ruleFour, $tempPassword)!=False){
            $databasePass = getUserValue('user_password', $_SESSION['username']);
            if(password_verify($userPasswordsObj['user_currentPassword'], $databasePass['user_password'])){
                $newPassword = password_hash($userPasswordsObj['user_password'], PASSWORD_DEFAULT);
                updateTableData('users', 'user_password', $newPassword, $_SESSION['username']);
                $resultArray['error'] = 'No error';
            }else{
                $resultArray['error'] = 'Not matching password';
            }
        }else{
            $resultArray['error'] = 'The current password is not valid';
        }
    }

    //$newArray['error'] = 'No error';
    //updateTableData('users', 'user_username', 'ricardo', $_SESSION['username']);
    //$_SESSION['username']='ricardo';
    //print_r($newArray);
    //$tableData = getUserData('user_username', $_SESSION['username']);
    echo json_encode($resultArray);
?>