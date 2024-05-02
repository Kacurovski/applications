<?php
session_start();
require_once('./php/autoload.php');

$user = $_SESSION['user'] ?? false;
$admin = $_SESSION['admin'] ?? false;

$book = new Book;
$comment = new Comment;

$selectedBook = $book->selectSingleBook($_GET['book_id'] ?? false);

$privateNotes = $book->selectPrivateNotes($_GET['book_id'] ?? false, $user['id'] ?? false);

$getApprovedComments = $comment->selectApprovedCommentsForSingleBook($selectedBook['book_id'] ?? false, $user['id'] ?? false);

$isLoggedIn = $admin || $user;

$welcomeText = $admin ? 'Welcome Admin' : ($user ? 'Welcome ' . $user['name'] : 'Guest');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="/book_app/css/login_page.css">
  <link rel="stylesheet" href="/book_app/css/global.css">
</head>

<body>
    <div class="container p-2">
        <?php include ('./php/templates/header.php'); ?>
        <div class="row">
            <div class="col-10 offset-1">
                <div class="row">
                    <div class="col-3">
                        <img src="<?= $selectedBook['book_image'] ?>" alt="image cover for the book" class="w-100" style="width: 300px;">
                    </div>
                    <div class="col-5">
                        <h1 class="text-center mb-5"><?= $selectedBook['book_title'] ?></h1>
                        <p>Author: <span class="fw-bold"><?= $selectedBook['author_name'] ?></span></p>
                        <p>Year of Issue: <span class="fw-bold"><?= $selectedBook['book_year'] ?></span></p>
                        <p>Number of Pages: <span class="fw-bold"><?= $selectedBook['book_pages'] ?></span></p>
                        <p>Category: <span class="fw-bold"><?= $selectedBook['category_title'] ?></span></p>
                    </div>
                    <div class="col-4">
                        <?= printPrivateNotes($privateNotes, $user['id'] ?? false); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-4">
            <div class="row">
                <div class="col-10 offset-1 bg-light text-dark p-4 rounded">
                    <h2 class="h4 fw-bold">About the author</h2>
                    <p class="mb-5"><?= $selectedBook['author_name'] ?></p>
                    <p><?= $selectedBook['author_bio'] ?></p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
            <?php displayMessage(); ?>
                <div class="col-10 offset-1 bg-light text-dark p-4 rounded">
                    <h3 class="h4 fw-bold mb-3">Comments</h3>
                    <?= printApprovedComments($getApprovedComments, $user['id'] ?? false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-10 offset-1 rounded py-4">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <form action="/book_app/add_comment" method="POST" id="comment_form" class="edit-table-form">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <input type="hidden" name="book_id" value="<?= $selectedBook['book_id'] ?>">
                            <div class="mb-3">
                                <label for="book_comment" class="form-label">Leave a Comment:</label>
                                <textarea class="form-control" name="book_comment" id="book_comment" rows="5" placeholder="Enter your comment here"></textarea>
                                <span class="input-error text-danger"></span>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
                    <?php } else { ?>
                        <?php echo (!$admin) ? '<p class="h5"><a href="/book_app/login" class="fw-bold text-decoration-none">Login</a> if you want to leave a comment.</p>' : ''; ?>
                    <?php } ?>

                </div>
            </div>
        </div>
        <?php include('./php/templates/footer.php') ?>
    </div>
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Note Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modal-note-description"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update script paths to be relative to the base URL -->
    <script src="/book_app/javascript/footer_api.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="/book_app/javascript/functions/functions.js"></script>
    <script src="/book_app/javascript/validations/handle_note.js"></script>
    <script src="/book_app/javascript/functions/edit_mode_note.js"></script>
    <script src="/book_app/javascript/validations/add_note.js"></script>
    <script src="/book_app/javascript/validations/forms_validations.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>