<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    session_start();
    require_once('autoload.php');

    if(inputValidation($_POST)){
        $selector = new Selector;
        $licenseData = $selector->getLicensePlate($_POST['license_plate']);
        if(empty($licenseData)){
            $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">There is no such record</p></div>';
            header('location:index.php');
            exit;
        }
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Please enter registration number</p></div>';
        header('location:index.php');
        exit;
    }    
} else {
    header('location:index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">Vehicle Registration</a>
        <a href="./login.php" class="btn btn-lg btn-outline-primary fs-6 fw-bold">login</a>
    </div>
</nav>
<div class="container text-center">
    <table class="table mb-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Vehicle Model</th>
                <th>Vehicle Type</th>
                <th>Chassis Number</th>
                <th>Production Year</th>
                <th>Registration Number</th>
                <th>Fuel Type</th>
                <th>Registration To</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rowNumber = 1;
            foreach ($licenseData as $row) { ?>
                <tr>
                    <td><?= $rowNumber++ ?></td>
                    <td><?= $row['vehicle_model'] ?></td>
                    <td><?= $row['vehicle_type'] ?></td>
                    <td><?= $row['chassis_number'] ?></td>
                    <td><?= $row['production_year'] ?></td>
                    <td><?= $row['registration_number'] ?></td>
                    <td><?= $row['fuel_type'] ?></td>
                    <td><?= $row['registration_to'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="./index.php" class="btn-lg btn-danger text-decoration-none"><i class="fas fa-arrow-left me-2"></i> Go back</a>
</div>
</body>
</html>