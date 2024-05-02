<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  session_start();
  require_once('../../autoload.php');

  if (inputValidation($_POST)) {
    $category = new Category;
    $category->setTitle($_POST['edited_title']);
    $category->updateCategory($_POST['category_id']);

    $_SESSION['message'] = ['content' => 'Category successfully updated', 'type' => 'success'];
    header('location: /book_app/admin_dashboard');
    exit;
  } else {
    header('location: /book_app/admin_dashboard');
    $_SESSION['message'] = ['content' => 'Please fill up all the fields', 'type' => 'danger'];
    exit;
  }
} else {
  header('location: book_app/');
  exit;
}

