<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    require_once('../../autoload.php');

    $book = new Book;

    $book->deleteBook($_POST['book_id']);
    
    header('location: /book_app/admin_dashboard');
    
} else {
    header('location: /book_app/admin_dashboard');
}

?>