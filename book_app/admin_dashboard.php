<?php
session_start();

if (!$_SESSION['admin']) {
    header("Location:index.php");
}

require_once('./php/autoload.php');

$category = new Category;
$author = new Author;
$book = new Book;

$getAllCategories = $category->selectAllCategories();
$getAllAuthors = $author->selectAllAuthors();
$getAllBooks = $book->selectAllBooks();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin_dashboard.css">
    <link rel="stylesheet" href="./css/global.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <header class="bg-secondary fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center w-75">
            <a href="/book_app"><img src="./assets/images/brainster-logo.png" alt="brainster logo" class="logo_img"></a>
        </div>
    </header>
    <div class="container">
        <h1 class="text-center">Admin Dashboard</h1>
    </div>

    <?php displayMessage(); ?>
    
    <div class="container">
        <!-- Categories -->
        <div class="card mb-5">
            <div class="card-header bg-info">
                <h2 class="text-center m-0">Categories</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="/book_app/add_category" id="category_form" class="w-50 mx-auto edit-table-form">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold h5">Title <span class="text-danger fw-normal h6">( required )</span></label>
                        <input type="text" name="title" class="form-control" id="category_title_input">
                        <span class="text-danger fw-bold input-error"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
            <div class="card-footer">
                <table class="table w-50 mx-auto table-hover">
                    <thead>
                        <tr class="text-center">
                            <th class="h5 fw-bold">Title</th>
                            <th class="h5 fw-bold" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= createRowsForAllCategories($getAllCategories) ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Authors -->
        <div class="card mb-5">
            <div class="card-header bg-info">
                <h2 class="text-center m-0">Authors</h2>
            </div>
            <div class="card-body">
                <form method="POST" id="author_form" action="/book_app/add_author" class="edit-table-form">
                    <div class="row g-3">
                        <div class="col mb-3">
                            <label for="name" class="form-label fw-bold">Name <span class="text-danger fw-normal">( required )</span></label>
                            <input type="text" name="name" class="form-control" id="author_name_input">
                            <span class="text-danger fw-bold input-error"></span>
                        </div>
                        <div class="col mb-3">
                            <label for="surname" class="form-label fw-bold">Surname <span class="text-danger fw-normal">( required )</span></label>
                            <input type="text" name="surname" class="form-control" id="author_surname_input">
                            <span class="text-danger fw-bold input-error"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label fw-bold">Bio <span class="text-danger fw-normal">( required, atleast 20 characters )</span></label>
                        <textarea type="text" name="author_bio" class="form-control" id="author_bio_input"></textarea>
                        <span class="text-danger fw-bold input-error"></span>
                    </div>
                    <button type="submit" class="btn btn-primary fw-bold w-25">Add Author</button>
                </form>
            </div>
            <div class="card-footer">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center h5 fw-bold">Name</th>
                            <th class="text-center h5 fw-bold">Surname</th>
                            <th class="text-center h5 fw-bold">Bio</th>
                            <th colspan="2" class="text-center h5 fw-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= createRowsForAllAuthors($getAllAuthors) ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Books -->
        <div class="card">
            <div class="card-header bg-info">
                <h2 class="text-center m-0">Books</h2>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="/book_app/add_book" id="book_form" class="edit-table-form">
                    <div class="row g-3">
                        <div class="col mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger fw-normal">( required )</span></label>
                            <input type="text" name="book_title" class="form-control" id="book_title">
                            <span class="text-danger fw-bold input-error"></span>
                        </div>
                        <div class="col mb-3">
                            <label for="author_id" class="form-label">Author <span class="text-danger fw-normal">( required )</span></label>
                            <select name="author_id" id="author_id" class="form-control">
                                <option value="" selected disabled>Select Author</option>
                                <?= printOptionsForAuthorNames($getAllAuthors) ?>
                            </select>
                            <span class="text-danger fw-bold input-error"></span>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col mb-3">
                            <label for="year_of_issue" class="form-label">Year of issue <span class="text-danger fw-normal">( required )</span></label>
                            <input type="number" name="year_of_issue" class="form-control" id="book_year_of_issue">
                            <span class="text-danger fw-bold input-error"></span>
                        </div>
                        <div class="col mb-3">
                            <label for="number_of_pages" class="form-label">Number of Pages <span class="text-danger fw-normal">( required )</span></label>
                            <input type="number" name="number_of_pages" class="form-control" id="book_number_of_pages">
                            <span class="text-danger fw-bold input-error"></span>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col mb-3">
                            <label for="category" class="form-label">Category <span class="text-danger fw-normal">( required )</span></label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" selected disabled>Select Category</option>
                                <?= printOptionsForCategories($getAllCategories) ?>
                            </select>
                            <span class="text-danger fw-bold input-error"></span>
                        </div>
                        <div class="col mb-3">
                            <label for="image_url" class="form-label">Image URL <span class="text-danger fw-normal">( required )</span></label>
                            <input type="text" name="image_url" class="form-control" id="book_image_url">
                            <span class="text-danger fw-bold input-error"></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary fw-bold w-25">Add Book</button>
                </form>
            </div>
            <div class="card-footer p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="nowrap text-center h5 fw-bold">Title</th>
                            <th class="nowrap text-center h5 fw-bold">Author</th>
                            <th class="nowrap text-center h5 fw-bold">Year of issue</th>
                            <th class="nowrap text-center h5 fw-bold">Number of pages</th>
                            <th class="nowrap text-center h5 fw-bold">Category</th>
                            <th class="nowrap text-center h5 fw-bold">Cover image</th>
                            <th colspan="3" class="text-center h5 fw-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= createRowsForAllBooks($getAllBooks, $getAllAuthors, $getAllCategories) ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include('./php/templates/footer.php') ?>

    <script src="/book_app/javascript/footer_api.js"></script>
    <script src="/book_app/javascript/functions/functions.js"></script>      
    <script src="/book_app/javascript/validations/edit_mode_tables.js"></script>
    <script src="/book_app/javascript/functions/sweetalert.js"></script>
    <script src="/book_app/javascript/validations/forms_validations.js"></script>

</body>

</html>