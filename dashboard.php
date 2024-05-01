<?php
session_start();

if(isset($_SESSION['admin'])){

    require_once('autoload.php');

    $user = $_SESSION['admin'];

    $selector = new Selector;

    $vehicleTypes = $selector->selectFromTable('vehicle_types');

    $fuelTypes = $selector->selectFromTable('fuel_types');

    $vehicleModels = $selector->selectFromTable('vehicle_models');

    $registrationRows = $selector->selectRegistrations();
 
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
</head>
<body> 
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
        <div class="container-fluid d-flex">
            <a class="navbar-brand" href="./index.php">Vehicle Registration</a>
            <div class="d-flex">
                <p class="h4 me-5 my-auto">Hello <?= $user ?></p>
                <form action="logout.php" method="POST">
                    <input type="submit" value="logout" class="btn btn-lg btn-outline-secondary fs-6 fw-bold">
                </form>
            </div>
        </div>
    </nav> 
    <div class="row my-4">
            <div class="col-6 offset-3">
            <h2 class="text-center">Add vehicle model</h2>
            <form action="add_vehicle_model.php" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" id="vehicle_model" name="vehicle_model">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
            </div>
        </div>
    <div class="container">
        <h1 class="text-center my-5">Vehicle Registration</h1>
        <form action="register_vehicle.php" method="POST">
            <div class="row">
                <div class="col-6 d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <label for="vehicle_model" class="form-label">Vehicle Model</label>
                        <select name="vehicle_model" id="vehicle_model" class="form-control">
                            <?php
                                foreach($vehicleModels as $vehicleModel){ ?>
                                    <option value="<?= $vehicleModel['id']?>"><?= $vehicleModel['model_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="vehicle_chasis_number" class="form-label">Vehicle chassis number</label>
                        <input type="text" class="form-control" id="vehicle_chasis_number" name="vehicle_chasis_number">
                    </div>
                    <div class="mb-3">
                        <label for="vehicle_registration_number" class="form-label">Vehicle registration number</label>
                        <input type="text" class="form-control" id="vehicle_registration_number" name="vehicle_registration_number">
                    </div>
                    <div class="mb-3">
                        <label for="registration_to" class="form-label">Registration to</label>
                        <input type="date" class="form-control" id="registration_to" name="registration_to">
                    </div>
                </div>
                <div class="col-6 d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <label for="vehicle_type" class="form-label">Vehicle type</label>
                        <select name="vehicle_type" id="vehicle_type" class="form-control">
                            <?php
                                foreach($vehicleTypes as $vehicleType){ ?>
                                    <option value="<?= $vehicleType['id']?>"><?= $vehicleType['type_name']?></option>
                               <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Vehicle_production_year" class="form-label">Vehicle production year</label>
                        <input type="date" class="form-control" id="Vehicle_production_year" name="vehicle_production_year">
                    </div>
                    <div class="mb-3">
                        <label for="fuel_type" class="form-label">Fuel type</label>
                        <select name="fuel_type" id="fuel_type" class="form-control">
                            <?php
                                foreach($fuelTypes as $fuelType){ ?>
                                    <option value="<?= $fuelType['id']?>"><?= $fuelType['fuel_type']?></option>
                               <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3 mt-auto">
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </div>
                </div>
            </div>
        </form>
        <?php
            if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
        } 
        if(!empty($registrationRows)){ ?>
            <div class="bg-light p-3 mt-5 border-radius">
                <form action="search.php" method="POST" class="d-flex w-50 ms-auto">
                    <input class="form-control me-2" type="search" placeholder="Search" name="criteria">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </div>
            <table class="table">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                   
                    $rowNumber = 1;
                    foreach ($registrationRows as $row) { 
                        $registrationToDate = new DateTime($row['registration_to']);
                        $currentDate = new DateTime();
                        $dateDifference = $currentDate->diff($registrationToDate)->format("%r%a");
                        
                        if ($dateDifference < 0) {
                            $registrationToClass = 'text-danger';
                        } elseif ($dateDifference <= 30) {
                            $registrationToClass = 'text-warning';
                        } else {
                            $registrationToClass = '';
                        } ?>
                        <tr>
                            <td><?= $rowNumber++ ?></td>
                            <td><?= $row['vehicle_model'] ?></td>
                            <td><?= $row['vehicle_type'] ?></td>
                            <td><?= $row['chassis_number'] ?></td>
                            <td><?= $row['production_year'] ?></td>
                            <td><?= $row['registration_number'] ?></td>
                            <td><?= $row['fuel_type'] ?></td>
                            <td class="<?= $registrationToClass ?> fw-bold"><?= $row['registration_to'] ?></td>
                            <td class="d-flex">
                            <form action="delete_registration.php" method="POST" class="me-2">
                                <input type="hidden" name="registration_id" value="<?php echo $row['registration_id'] ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <form action="edit_registration.php" method="POST" class="me-2">
                                <input type="hidden" name="registration_id" value="<?php echo $row['registration_id'] ?>">
                                <button type="submit" class="btn btn-warning">Edit</button>
                            </form>
                            <?php
                                if($dateDifference <= 30){ ?>
                                    <form action="extend_registration.php" method="POST">
                                        <input type="hidden" name="registration_id" value="<?php echo $row['registration_id'] ?>">
                                        <button type="submit" class="btn btn-success" name="extend">Extend</button>
                                    </form>
                            <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</body>
</html>
           

