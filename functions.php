<?php


function dataExplode() {
    $usersData = trim(file_get_contents('users.txt'));
    $users = explode(PHP_EOL, $usersData);
    
    $allUserData = array();

    foreach ($users as $user) {
        $userData = explode(',', $user);
        $emailExploded = trim($userData[0]);
        $usernameAndHashedPassword = explode('=', $userData[1]);

        array_push($usernameAndHashedPassword, $emailExploded);
        $preData = $usernameAndHashedPassword;
        
        $fullData = [
            'username' => trim($preData[0]),
            'password' => trim($preData[1]),
            'email' => trim($preData[2])
        ];

        $allUserData[] = $fullData;
    }

    return $allUserData;
}



function redirect($location) {
    header('Location: ' . $location);
    die();
}

function emptyValidation($input){
    if(!isset($input) || empty($input)){
        return true;
    }
}

function usernameValidation($username){
    $usernameRegex = '/^[a-zA-Z0-9]+$/';
    if (preg_match($usernameRegex, $username)){
        return true;
    }
}

function emailValidation($email){
    $emailRegex = '/^.{5,}@/';
    if (preg_match($emailRegex, $email)){
        return true;
    }
}

function passwordValidation($password){
    $passwordRegex = '/^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z]).{8,}$/';
    if (preg_match($passwordRegex, $password)){
        return true;
    }
}

function errorGenerator($reason){
    if($reason == 'A user with this email already exists' || $reason == 'Username taken'){
        return '<p class="text-warning fs-6 fw-bold">' . $reason . '</p>';
    } else {
        return '<p class="text-danger fs-6 fw-bold">' . $reason . '</p>';
    }
}

?>