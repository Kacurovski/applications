<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{


    require_once('../../autoload.php');

    $comment = new Comment;

    $comment->deleteComment($_POST['comment_id']);

    header('Location: /book_app/single_book/' . $_POST['book_id']);
    
} else {
    header('location: book_app/');
}

?>