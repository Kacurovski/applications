<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    session_start();
    require_once('../../autoload.php');

    $comment = new Comment;

    if ($_POST['action'] == 'approve') { 
        $comment->handleComment($_POST['comment_id'], 'approve');
    } else if ($_POST['action'] == 'decline') {  
        $comment->handleComment($_POST['comment_id'], 'decline');
    }
    
    header('location: /book_app/book_comments/' . $_POST['book_id']);
} else {
    header('location: book_app/');
}
?>