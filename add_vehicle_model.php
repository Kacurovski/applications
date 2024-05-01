<?php

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    session_start();
    require_once('autoload.php');

    if(inputValidation($_POST)){
        $registration = new Registration;
        $registration->addVehicleModel($_POST['vehicle_model']);
    
        header('location:dashboard.php');
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Pls enter a vehicle model</p></div>';
        header('location:dashboard.php');
    }
} else {
    header('location:index.php');
}
?>