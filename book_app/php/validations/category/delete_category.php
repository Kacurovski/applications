<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    require_once('../../autoload.php');

    $category = new Category;

    $category->deleteCategory($_POST['category_id']);
    
    header('location: /book_app/admin_dashboard');
} else {
    header('location: book_app/');
}

?>