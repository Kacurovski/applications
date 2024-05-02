<?php
session_start();

require_once('./php/autoload.php');

$book = new Book;

$selectedBook = $book->selectSingleBook($_GET['book_id']);

if(!$selectedBook){
  header("Location: /book_app");
}

$comment = new Comment;

$bookComments = $comment->selectAllCommentsForSingleBook($_GET['book_id']);

$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : false;

$isLoggedIn = $admin;

$welcomeText = $admin ? 'Welcome Admin' : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Book Comments</title>
  <link rel="stylesheet" href="/book_app/css/login_page.css">
  <link rel="stylesheet" href="/book_app/css/global.css">
</head>

<body>
  <div class="container">
    <?php include ('./php/templates/header.php')?>
    <div class="row mb-5">
      <div class="col-8 offset-2">
        <div class="row">
          <div class="col-3">
            <img src="<?= $selectedBook['book_image'] ?>" alt="image cover for the book" class="w-100 img-fluid rounded">
          </div>
          <div class="col-9">
            <h1 class="text-center mb-5"><?= $selectedBook['book_title'] ?></h1>
            <p class="mb-2">Author: <span class="fw-bold"><?= $selectedBook['author_name'] ?></span></p>
            <p class="mb-2">Year of Issue: <span class="fw-bold"><?= $selectedBook['book_year'] ?></span></p>
            <p class="mb-2">Number of Pages: <span class="fw-bold"><?= $selectedBook['book_pages'] ?></span></p>
            <p class="mb-2">Category: <span class="fw-bold"><?= $selectedBook['category_title'] ?></span></p>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-center">
          <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <input type="checkbox" class="btn-check" id="show_non_approved_comments" autocomplete="off">
            <label class="btn btn-outline-danger fw-bold px-5" for="show_non_approved_comments">Show Non-approved Comments</label>
          </div>
        </div>
        <?php displayMessage(); ?>
        <div class="container m-0" id="all_comments">
          <h1 class="h1 text-secondary text-center">All Comments</h1>
              <?= $allCommentsRows = createTableForBookComments($bookComments, 'all'); ?>
        </div>
        <div class="container d-none" id="non_approved_comments">
          <h1 class="h1 text-danger text-center">Non Approved Comments</h1>
              <?= $allCommentsRows = createTableForBookComments($bookComments, 'non-approved'); ?>
        </div>
      </div>
    </div>
    <?php include('./php/templates/footer.php') ?>
  </div>
   <script src="/book_app/javascript/footer_api.js"></script>
   <script src="/book_app/javascript/functions/filter_comments.js"></script>
</html>