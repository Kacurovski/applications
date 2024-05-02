<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    require_once('../../autoload.php');

    $params = [
        'title' => trim($_POST['book_title']),
        'author_id' => trim($_POST['author_id']),
        'year_of_issue' => trim($_POST['year_of_issue']),
        'number_of_pages' => trim($_POST['number_of_pages']),
        'category_id' => trim($_POST['category_id']),
        'image' => trim($_POST['image_url'])
    ];

    if (inputValidation($params)) {
        $book = new Book();
        $book->addBook($params);
        header("Location: /book_app/admin_dashboard");
        exit;
    } else {
        $_SESSION['message'] = ['content' => 'Please fill up all the fields', 'type' => 'danger'];
        header("Location: /book_app/admin_dashboard");
        exit;
    }
} else {
    header("Location: /book_app/");
    exit;
}
?>../