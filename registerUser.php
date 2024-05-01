<?php

session_start();

include_once('functions.php');

$errors = array(
    'username' => '',
    'password' => '',
    'email' => ''

);




if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
    die();
}


$username = trim($_POST['username']);
$password = trim($_POST['password']);
$email = trim($_POST['email']);



$_SESSION['usernamePreFill'] = $username;
$_SESSION['emailPreFill'] = $email;


$fullData = dataExplode();

if(emptyValidation($username)){
    $errors['username'] = 'Please enter Username ';
} else {
        foreach($fullData as $key => $value){
            if ($value['username'] == $username) {
                $errors['username'] = 'Username taken';
                break;
            }
        }
    }

if(emptyValidation($password)){
    $errors['password'] = 'Please enter password ';
    
} else if (!passwordValidation($password)){
    $errors['password'] = 'Password must have at least one number, one special sign and one uppercase letter';
    
}

if(emptyValidation($email)){
    $errors['email'] = 'Please enter email';
    
} else if (!emailValidation($email)){
    $errors['email'] = 'Email must have at least 5 characters before @'; 
} else {
    foreach($fullData as $key => $value){
        if ($value['email'] === $email) {
            $errors['email'] = 'A user with this email already exists';
            break;
        }
    }  
}


if(!array_filter($errors)){
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $userData = "$email, $username = $hashedPassword". PHP_EOL;
    file_put_contents('users.txt', $userData, FILE_APPEND);
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    redirect('welcome.php');
}  else {
    $_SESSION['errors'] = $errors;
    redirect('register.php');
}



?>