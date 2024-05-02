<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    require_once('../../autoload.php');

    $author = new Author;

    $author->deleteAuthor($_POST['author_id']);
    
    header('location: /book_app/admin_dashboard');
    
} else {
    header('location: book_app/');
}

?>