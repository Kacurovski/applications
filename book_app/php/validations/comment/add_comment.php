<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);

    require_once('../../autoload.php');

    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];

    if (inputValidation($_POST)) {
        $comment = new Comment;

        if (!$comment->hasUserCommentedOnBook($user_id, $book_id)) {
            $comment_id = $comment->addComment($_POST['book_comment']);

            if ($comment_id !== false) {
                $comment->addCommentToPivotTable($book_id, $comment_id, $user_id);
                $_SESSION['message'] = ['content' => 'Comment Successfully added', 'type' => 'success'];
            } else {
                $_SESSION['message'] = ['content' => 'Something went wrong.', 'type' => 'danger'];
            }
        } else {
            header('Location: /book_app/single_book/' . $book_id);
            $_SESSION['message'] = ['content' => 'You have already commented on this book', 'type' => 'danger'];
        }
    } else {
        header('Location: /book_app/single_book/' . $book_id);
        $_SESSION['message'] = ['content' => 'Comment cannot be empty', 'type' => 'danger'];
    }

    header('Location: /book_app/single_book/' . $book_id);
} else {
    header('Location: book_app/');
}
?>
