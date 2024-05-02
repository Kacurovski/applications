<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    require_once('../../autoload.php');

    
    $params = [
        'name' => trim($_POST['author_name']),
        'surname' => trim($_POST['author_surname']),
        'bio' => trim($_POST['author_bio']),
    ];

    if (inputValidation($params) && strlen($params['bio']) >= 20) {
        $author = new Author;
        $author->setName($params['name']);
        $author->setSurname($params['surname']);
        $author->setBio($params['bio']);

        $author->editAuthor($_POST['author_id']);

        $_SESSION['message'] = ['content' => 'Author successfully updated', 'type' => 'success'];
        header('location: /book_app/admin_dashboard');
        exit;
    } else {
        $_SESSION['message'] = ['content' => 'Please fill up all the fields', 'type' => 'danger'];
        header('location: /book_app/admin_dashboard');
        exit;
    }
} else {
    header('location: book_app/');
    exit;
}