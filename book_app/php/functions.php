<?php

function inputValidation(array $inputs)
{
    foreach ($inputs as $input) {
        if (empty($input) || !isset($input)) {
            return false;
        }
    }
    return true;
}

function printAllBooks($books)
{
    $data = '';
    foreach ($books as $row) {
        $data .= '<div class="col-12 col-md-3 mb-4 book-card" id="' . $row['category_title'] . '">
            <div class="card shadow-lg">
                     <a href="/book_app/single_book/' . $row['book_id'] . '" class="text-decoration-none text-dark">
                     <img src="' . $row['book_image'] . '" class="card-img-top" alt="Book Image">
                    <div class="card-body">
                        <p class="h4 card-title" data-searchable="' . $row['book_title'] . '">' . $row['book_title'] . '</p>
                        <p class="card-text mb-4">Author: <span class="fw-bold">' . $row['author_name'] . '</span></p>
                        <p class="card-text">Category: <span class="fw-bold">' . $row['category_title'] . '</span></p>
                    </div>
                </a>
            </div>
        </div>';
    }
    return $data;
}



function printCheckboxesForCategories($categories)
{
    $data = '';
    foreach ($categories as $category) {
        $data .= '<input type="checkbox" class="btn-check ' . $category['title'] . '" id="' . $category['title'] . '" value="' . $category['title'] . '" autocomplete="off">
              <label class="btn btn-outline-primary fw-bold" for="' . $category['title'] . '">' . $category['title'] . '</label>';
    }
    return $data;
}

function printApprovedComments($comments, $loggedInUserId)
{
    $data = '';
    foreach ($comments as $comment) {
        $userCanDelete = ($comment['user_id'] === $loggedInUserId || $comment['is_approved'] === true);

        if ($userCanDelete) {
            $data .= '<form method="post" action="/book_app/delete_comment" class="d-flex justify-content-between align-items-center edit-table-form">';
        } else {
            $data .= '<div>';
        }

        $data .= '<p class="mb-1"><span class="fw-bold">' . $comment['user_name'] . ' ' . $comment['user_surname'] . ': </span>' . $comment['content'] . '</p>';

        if ($userCanDelete) {
            $data .= '
            <input type="hidden" name="book_id" value="'. $_GET['book_id'] .'">
            <input type="hidden" name="comment_id" value="' . $comment['comment_id'] . '">
            <span class="input-error text-dark fw-bold"></span>
            <button class="btn btn-danger" type="submit">Delete</button>
            ';
            $data .= '</form>';
        } else { 
            $data .= '</div>';
        }
    }

    return $data;
}

function printPrivateNotes($notes, $user)
{
    $data = '';
    $bookId = $_GET['book_id'];

    if ($user) {
        $data .= '<div class="border p-2 rounded shadow-sm overflow-auto notes-box-holder">
                    <div class="d-flex justify-content-between mb-4 align-items-center">
                        <p class="fw-bold text-success text-center h5">Private Notes</p>
                        <button type="button" class="btn btn-primary" onclick="addPrivateNote(event)">New Note</button>
                    </div>
                    <div class="add-note-container border p-2 mb-4 d-none">
                        <form id="add-note-form" method="POST">
                            <textarea name="add_note_text" placeholder="Write your private note here..." class="w-100" rows="4" cols="50"></textarea>
                            <input type="hidden" name="book_id" value="'. $bookId .'">
                            <input type="hidden" name="user_id" value="'. $user .'">
                            <button type="submit" class="btn btn-success">Add Note</button>
                        </form>
                    </div>
                    <div id="created-notes-container">
                    ';
                    foreach ($notes as $note) {    
                        $data .= '
                        <div class="border p-2 rounded shadow-sm mb-3">
                            <form class="d-flex flex-column private-notes-form" method="POST">  
                                <span class="loading d-none mb-1">Loading...</span>                  
                                <p class="h6 mb-3 note text-break break-word">' . sliceNote($note['note_text']) . '</p>  
                                <textarea name="note_text" class="mb-2 d-none" value="' . $note['note_text'] . '">' . $note['note_text'] . '</textarea>
                                <input type="hidden" name="user_id" value="' . $user . '">
                                <input type="hidden" name="note_id" value="'. $note['note_id'] .'">
                                <input type="hidden" name="action" value="">
                                ';    
                        $data .= '   
                        <div class="d-flex">                  
                            <button type="submit" value="delete" class="btn-sm btn-outline-danger p-1 me-1 px-3 border-0">Delete</button>
                            <button type="button" value="edit" class="btn-sm btn-outline-success p-1 me-1 px-3 border-0" data-state="Edit" onclick="editNoteMode(event)">Edit</button>
                            <button type="button" class="btn-sm btn-outline-primary p-1 me-1 px-3 border-0" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="viewNoteDescription(event)">View</button>  
                        </div>
                    </form></div>';
                    }

        $data .= '</div></div>';
        return $data;
    }
    return '';   
}


function sliceNote($note) {
    return strlen($note) > 50 ? substr($note, 0, 50) . '...' : $note;
}

function passwordValidation($password) {
    $strongPasswordRegex = '/^(?=.*[A-Z])(?=.*\d).{8,}$/';

    return preg_match($strongPasswordRegex, $password) === 1;
}


function createRowsForAllCategories($categories)
{
    $tableRows = '';
    foreach ($categories as $category) {
        $tableRows .= '<tr class="h6">
                        <form action="/book_app/update_category" class="category-form edit-table-form" method="POST">
                            <td class="editable-element text-center align-middle">                     
                                <p class="fw-bold category-title m-0">' . $category['title'] . '</p>  
                                <input type="text" name="edited_title" value="' . $category['title'] . '" class="d-none category-title-input form-control"> 
                                <span class="input-error text-danger"></span>
                            </td>   
                            <span class="table-category-error text-danger"></span> 
                            <td class="d-flex justify-content-end">                         
                                <input type="hidden" name="category_id" value="' . $category['id'] . '"> 
                                <button type="submit" class="btn btn-warning edit-update-btn">Edit</button>                             
                            </td>
                        </form>  
                        <td>
                            <form action="./php/validations/category/delete_category.php" method="POST">
                                <input type="hidden" name="category_id" value="' . $category['id'] . '"> 
                                <button type="submit" class="btn btn-danger">Delete</button>   
                            </form>
                        </td>
            </tr>';
    }
    return $tableRows;
}

function createRowsForAllBooks($books, $authorCategory, $categories)
{
    $tableRows = '';
    foreach ($books as $book) {
        $tableRows .= '<tr>
              <form action="/book_app/update_book" method="POST" class="d-flex book-table-form edit-table-form">                
                <td class="align-middle text-center"> <p class="m-0">' . $book['book_title'] . ' </p>
                <input type="text" name="edited_book_title" class="d-none form-control" value="' . $book['book_title'] . '">
                </td>
                <td class="align-middle text-center"> 
                    <p class="m-0">' . $book['author_name'] . ' </p>                    
                    <select name="edited_book_author" class="d-none form-select" selected="' . $book['author_id'] . '"> 
                        ' . printOptionsForAuthorNames($authorCategory, $book['author_id']) . '
                    </select>
                    <span class="input-error text-danger"></span>
                </td>
                <td class="align-middle text-center"> 
                    <p class="m-0">' . $book['book_year'] . ' </p>
                    <input type="number" name="edited_book_year" class="d-none form-control" value="' . $book['book_year'] . '">
                    <span class="input-error text-danger"></span>
                </td>
                <td class="align-middle text-center"> 
                    <p class="m-0"> ' . $book['book_pages'] . '</p>
                    <input type="number" name="edited_book_pages" class="d-none form-control" value="' . $book['book_pages'] . '">
                    <span class="input-error text-danger"></span>
                </td>
                <td class="align-middle text-center"> 
                    <p class="m-0"> ' . $book['category_title'] . '</p>                    
                    <select name="edited_book_category" class="d-none form-select" selected="' . $book['category_id'] . '">
                    ' . printOptionsForCategories($categories, $book['category_id']) . '
                    </select>
                    <span class="input-error text-danger"></span>
                </td>
                <td class="align-middle text-center">
                    <img src="' . $book['book_image'] . '" alt="cover image of the book" style="width: 50px">
                    <input type="text" name="edited_book_image" value="' . $book['book_image'] . '" class="d-none form-control">
                    <span class="input-error text-danger"></span>
                </td>
                <td class="align-middle text-center">                
                    <input type="hidden" name="book_id" value="' . $book['book_id'] . '">
                    <button type="submit" class="btn btn-warning me-3 edit-update-btn">Edit</button>
                </td>
                </form>       
                <td class="align-middle text-center">
                    <button type="submit" class="btn btn-danger delete-book" data-book-id="' . $book['book_id'] . '">Delete</button>
                </td>
                <td class="align-middle text-center">
                    <a href="/book_app/book_comments/' . $book['book_id'] . '" class="btn btn-success">Comments</a>
                </td>
            
        </tr>';
    }
    return $tableRows;
}

function createRowsForAllAuthors($authors)
{
    $tableRows = '';
    foreach ($authors as $author) {
        $tableRows .= '<tr>
                <form action="/book_app/update_author" method="POST" class="update_author_form edit-table-form">
                    <td class="align-middle text-center">
                        <p class="m-0"> ' . $author['name'] . ' </p>
                        <input type ="text" name="author_name" class="d-none form-control input" value="' . $author['name'] . '">
                        <span class="input-error text-danger fw-bold"></span>
                    </td>
                    <td class="align-middle text-center">
                        <p class="m-0">' . $author['surname'] . '</p>
                        <input type="text" name="author_surname" class="d-none form-control" value="' . $author['surname'] . '">
                        <span class="input-error text-danger fw-bold"></span>
                    </td>
                    <td class="align-middle text-center">
                        <p class="m-0">' . $author['bio'] . '</p>
                        <input type="text" name="author_bio" class="d-none form-control" value="' . $author['bio'] . '">
                        <span class="input-error text-danger fw-bold"></span>
                    </td>
                    <td class="align-middle text-end">
                        <input type="hidden" name="author_id" value="' . $author['id'] . '">
                        <button type="submit" class="btn btn-warning edit-update-btn">Edit</button>   
                    </td>
                </form>  
                <td>
                <form action="./php/validations/author/delete_author.php" method="POST">
                    <input type="hidden" name="author_id" value="' . $author['id'] . '">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>';
    }
    return $tableRows;
}

function printOptionsForAuthorNames($authors, $selectedAuthorId = null)
{
    $options = '';
    foreach ($authors as $author) {
        $selected = ($author['id'] == $selectedAuthorId) ? 'selected="selected"' : '';
        $options .= '<option value="' . $author['id'] . '" ' . $selected . '>' . $author['name'] . ' ' . $author['surname'] . '</option>';
    }
    return $options;
}

function printOptionsForCategories($categories, $selectedCategoryId = null)
{
    $options = '';
    foreach ($categories as $category) {
        $selected = ($category['id'] == $selectedCategoryId) ? 'selected="selected"' : '';
        $options .= '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['title'] . '</option>';
    }
    return $options;
}

function createTableForBookComments($comments, $approvalStatus)
{
    $tableHeadColor = $approvalStatus == 'all' ? 'table-primary' : 'table-danger';

    $table = '<table class="table">
                <thead class="' . $tableHeadColor . '">
                    <tr>
                        <th class="text-center">Content</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Approval Status</th>
                        <th class="text-start">Action</th>
                    </tr>
                </thead>
                <tbody>';

    $commentsExist = false;

    foreach ($comments as $comment) {
        $isApproved = $comment['is_approved'];
        $isNew = $comment['is_new'];

        if (($approvalStatus == 'non-approved' && !$isApproved) || $approvalStatus == 'all') {
            $commentsExist = true;

            $approvalStatusText = $isApproved ? 'Approved' : ($isNew ? 'New' : 'Not Approved');
            $buttonHTML = '';

            if ($isNew && !$isApproved) {
                $buttonHTML = '<form action="/book_app/handle_comment" method="POST">
                                    <input type="hidden" name="book_id" value="' . $comment['book_id'] . '">
                                    <input type="hidden" name="comment_id" value="' . $comment['comment_id'] . '">
                                    <button type="submit" class="btn btn-success me-2" name="action" value="approve">Approve</button>
                                    <button type="submit" class="btn btn-danger" name="action" value="decline">Decline</button>
                                </form>';
            } elseif (!$isNew && !$isApproved) {
                $buttonHTML = '<form action="/book_app/handle_comment" method="POST">
                                    <input type="hidden" name="book_id" value="' . $comment['book_id'] . '">
                                    <input type="hidden" name="comment_id" value="' . $comment['comment_id'] . '">
                                    <button type="submit" class="btn btn-success me-2" name="action" value="approve">Approve</button>
                                </form>';
            }

            $fwBoldClass = $isNew ? 'fw-bold' : '';

            $table .= '<tr>
                <td class="text-center align-middle py-4">' . $comment['content'] . '</td>
                <td class="text-center align-middle py-4">' . $comment['created_at'] . '</td>
                <td class="text-center align-middle py-4 ' . $fwBoldClass . '">' . $approvalStatusText . '</td>
                <td class="text-start align-middle py-4">' . $buttonHTML . '</td>
            </tr>';
        }
    }

    $table .= '</tbody></table>';

    if (!$commentsExist) {
        $table = '<p class="text-center text-danger fst-italic fw-bold">No Comments</p>';
    }

    return $table;
}


function displayMessage()
{
    if (isset($_SESSION['message']) && is_array($_SESSION['message'])) {
        $content = $_SESSION['message']['content'];
        $type = $_SESSION['message']['type'];
        echo "<div class='alert alert-$type mt-3 h5 mb-3 w-75 m-auto'><p class='text-center m-0'>$content</p></div>";
        unset($_SESSION['message']);
    }
}