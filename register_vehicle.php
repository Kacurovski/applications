<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    session_start();
    require_once('autoload.php');

    if(inputValidation($_POST)){
        $registration = new Registration;
        $registration->setVehicleModelId(trim($_POST['vehicle_model']));
        $registration->setVehicleTypeId(trim($_POST['vehicle_type']));
        $registration->setVehicleChassisNumber(trim($_POST['vehicle_chasis_number']));
        $registration->setProductionYear(trim($_POST['vehicle_production_year']));
        $registration->setRegistrationNumber(trim($_POST['vehicle_registration_number']));
        $registration->setFuelType(trim($_POST['fuel_type']));
        $registration->setRegistrationTo(trim($_POST['registration_to']));
        $registration->store();
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Please complete all fields before registering.</p></div>';
    }
    header('location:dashboard.php');         
} else {
    header('location:index.php');   
}
