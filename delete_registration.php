<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    require_once('autoload.php');

    $registration = new Registration;
    $registration->delete($_POST['registration_id']);
    header('location:dashboard.php');
} else {
    header('location:index.php');
}


?>