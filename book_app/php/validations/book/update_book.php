<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  session_start();
  require_once('../../autoload.php');

  if (inputValidation($_POST)) {
      $book = new Book;
      $book->setTitle($_POST['edited_book_title']);
      $book->setAuthorId($_POST['edited_book_author']);
      $book->setYearOfIssue($_POST['edited_book_year']);
      $book->setNumberOfPages($_POST['edited_book_pages']);
      $book->setCategoryId($_POST['edited_book_category']);
      $book->setImage($_POST['edited_book_image']);

      $book->editBook($_POST['book_id']);

      header('location: /book_app/admin_dashboard');
      exit;
  } else {
      $_SESSION['message'] = ['content' => 'Please fill up all the fields', 'type' => 'danger'];
      header('location: book_app/admin_dashboard');
      exit;
  }
} else {
  header('location: book_app/');
  exit;
}
?>
?>