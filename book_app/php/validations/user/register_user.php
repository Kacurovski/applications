<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    session_start();
    require_once('../../autoload.php');

    if(inputValidation($_POST) && passwordValidation($_POST['register_password'])){
        $password = trim($_POST['register_password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $user = new User;
        $user->setName(trim($_POST['register_name']));
        $user->setSurname(trim($_POST['register_surname']));
        $user->setEmail(trim($_POST['register_email']));
        $user->setPassword($hashedPassword);
        $user->registerUser();
    } else {
        $_SESSION['message'] = ['content' => 'Please complete all fields before registering.', 'type' => 'danger'];
    }
    header('location: /book_app/signup');         
} else {
    header('location: book_app/');   
}
