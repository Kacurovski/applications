<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    require_once('../../autoload.php');

    $_POST = array_map('trim', $_POST);

    if (inputValidation($_POST)) {
        $category = new Category;
        $category->addCategory($_POST['title']);

        header('location: /book_app/admin_dashboard');
        exit;
    } else {
        $_SESSION['message'] = ['content' => 'Please fill up all the fields', 'type' => 'danger'];
        header('location: /book_app/admin_dashboard');
        exit;
    }
} else {
    header('location: /book_app/');
    exit;
}
?>