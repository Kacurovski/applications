<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") { 
    require_once('../autoload.php');

    $noteId = isset($_POST['noteId']) ? $_POST['noteId'] : null;
    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
    $noteText = isset($_POST['noteText']) ? $_POST['noteText'] : null;
    $action = isset($_POST['action']) ? $_POST['action'] : null;
   
    if ($action === 'update') {
        $book = new Book();
        $result = $book->updatePrivateNotes($noteText, $noteId);

        if ($result) {
            $responseData = array(
                "status" => "success",
                "message" => `Note successfully updated`,
            );
        } else {
            $responseData = array(
                "status" => "error",
                "message" => "Something went wrong in Update Action",               
            );
        }
    } elseif ($action === 'delete') {
        $book = new Book();

        $result = $book->deletePrivateNotes($noteId);
        $responseData = array(
            "status" => "success",
            "message" => "Note deleted succesfully",
        );
    } else {
        $responseData = array(
            "status" => "error",
            "message" => "Something went wrong deleting the book",
        );

    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($responseData);
    exit;
} 
?>
