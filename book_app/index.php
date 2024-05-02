<?php

session_start();

require_once('./php/autoload.php');

$category = new Category;

$book = new Book;

$getAllBooks = $book->selectAllBooks();

$getAllCategories = $category->selectAllCategories();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : false;

$isLoggedIn = $admin || $user;

$welcomeText = $admin ? 'Welcome Admin' : ($user ? 'Welcome ' . $user['name'] : 'Guest');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brainster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/homepage.css">
</head>

<body>
    <?php include ('./php/templates/header.php')?>
    <section class="banner_section d-flex justify-content-center align-items-center vh-100">
        <h1 class="text-light display-3 fw-bold ms-5">Discover Your Next Favorite Book Now</h1>
    </section>
    <section class="books_section container py-5 mb-2">
        <h2 class="text-center mb-3">Search Book By Title</h2>
        <div class="mb-4 w-50 mx-auto">
            <input type="text" class="form-control" id="book_title_input" placeholder="Enter Book Title" onchange="">
        </div>
        <h2 class="text-center mb-5">Select Book By Category</h2>
        <div class="btn-group d-flex mb-4" role="group" aria-label="Basic checkbox toggle button group">
            <?= printCheckboxesForCategories($getAllCategories) ?>
        </div>
        <div class="row" id="bookCardsContainer">
            <?= printAllBooks($getAllBooks) ?>
        </div>
    </section>
    <?php include ('./php/templates/footer.php')?>
    
    <script src="/book_app/javascript/functions/functions.js"></script>
    <script src="/book_app/javascript/functions/book_filter.js"></script>
    <script src="/book_app/javascript/footer_api.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</body>

</html>