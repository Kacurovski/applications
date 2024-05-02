<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    require_once('../../autoload.php');

    if(isset($_SESSION['admin'])){
        unset ($_SESSION['admin']);
    };

    if(isset($_SESSION['user'])){
        unset ($_SESSION['user']);
    };

    header('Location: /book_app');
    exit();
} else {
    header('Location: /book_app');
}