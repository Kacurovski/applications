<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once('../autoload.php');

    $bookId = isset($_POST['bookId']) ? $_POST['bookId'] : null;
    $user = isset($_POST['userId']) ? $_POST['userId'] : null;
    $noteText = isset($_POST['noteText']) ? $_POST['noteText'] : null;

    $book = new Book;
    $result = $book->addPrivateNote($user, $bookId, $noteText);

    if ($result) {        
        $responseData = [
            "status" => "success",
            "message" => "Note successfully added",
            "note_id" => $result,
        ];
    } else {        
        $responseData = [
            "status" => "error",
            "message" => "Something went wrong",
        ];
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($responseData);
    exit;
}
?>