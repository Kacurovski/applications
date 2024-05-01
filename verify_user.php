<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    
    require_once('autoload.php');

    $admin = new Admin;
    $admin->setUsername($_POST['username']);
    $admin->setPassword($_POST['password']);

    $isAuthenticated = $admin->authenticate();

    if ($isAuthenticated) {
        $_SESSION['admin'] = $admin->getUsername();
        header('location:dashboard.php');
    } else {
        $_SESSION['login_error'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto">
        <p class="text-center m-0">Wrong Credentials</p></div>';
        header('location:login.php');
    }
} else {
    header('location:index.php');
}
?>