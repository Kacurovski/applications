<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();

    require_once('../../autoload.php');

    if (inputValidation($_POST)) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $admin = new Admin;
        $admin->setEmail($email);
        $admin->setPassword($password);

        $isAdminAuthenticated = $admin->authenticate();

        if ($isAdminAuthenticated) {
            $_SESSION['admin'] = $admin->getEmail();
            header('location: /book_app');
        } else {
            $user = new User;
            $user->setEmail($email);
            $user->setPassword($password);

            $isUserAuthenticated = $user->authenticate();

            if ($isUserAuthenticated) {
                $_SESSION['user'] = $isUserAuthenticated;
                header('location: /book_app');
            } else {
                $_SESSION['message'] = ['content' => 'Invalid email or password. Please try again.', 'type' => 'danger'];
                header('location: /book_app/login');
            }
        }
    } else {
        $_SESSION['message'] = ['content' => 'Please fill up all the fields', 'type' => 'danger'];
        header('location: /book_app/login');
    }
}
