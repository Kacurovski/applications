<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    require_once('../../autoload.php');

    $params = [
        'name' => trim($_POST['name']),
        'surname' => trim($_POST['surname']),
        'bio' => trim($_POST['author_bio']),
    ];

    if (inputValidation($params) && strlen($params['bio']) >= 20) {
        $author = new Author();
        $author->addAuthor($params);
        $_SESSION['message'] = ['content' => 'Author successfully added', 'type' => 'success'];
        header("Location: /book_app/admin_dashboard");
        exit;
    } else {
        $_SESSION['message'] = ['content' => 'Please fill up all the fields', 'type' => 'danger'];
        header("Location: /book_app/admin_dashboard");
        exit;
    }
} else {
    header("Location: /book_app");
    exit;
}