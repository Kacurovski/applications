<?php
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    session_start();
    require_once('autoload.php');

    $registration = New Registration;

    $registration->setVehicleModelId($_POST['vehicle_model']);
    $registration->setVehicleTypeId($_POST['vehicle_type']);
    $registration->setVehicleChassisNumber($_POST['vehicle_chasis_number']);
    $registration->setProductionYear($_POST['vehicle_production_year']);
    $registration->setRegistrationNumber($_POST['vehicle_registration_number']);
    $registration->setFuelType($_POST['fuel_type']);
    $registration->setRegistrationTo($_POST['registration_to']);

    $registration->updateRegistration($_POST['registration_id']);
    
    header('location:dashboard.php');
} else {
    header('location:index.php');
}

?>