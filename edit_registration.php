<?php

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    require_once('autoload.php');

    $pdo = DB::connect();

    $selector = new Selector;

    $vehicleTypes = $selector->selectFromTable('vehicle_types');

    $fuelTypes = $selector->selectFromTable('fuel_types');

    $vehicleModels = $selector->selectFromTable('vehicle_models');

    $singleRegistration = $selector->selectSingleRegistration($_POST['registration_id']);

} else{
    header('location:index.php');
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
                <form action="logout.php" method="POST">
                    <input type="submit" value="logout" class="btn btn-lg btn-outline-secondary fs-6 fw-bold">
                </form>
            </div>
    </nav>
<div class="container">
    <form action="update_registration.php" method="POST" class="mb-5">
                <div class="row">
                    <div class="col-6 d-flex flex-column justify-content-between">
                        <div class="mb-3">
                            <input type="hidden" name="registration_id" value="<?= $singleRegistration['id']?>">
                            <label for="vehicle_model" class="form-label">Vehicle Model</label>
                            <select name="vehicle_model" id="vehicle_model" class="form-control">
                            <?php
                                foreach ($vehicleModels as $vehicleModel) {
                                    $selected = ($vehicleModel['id'] == $singleRegistration['vehicle_model_id']) ? 'selected' : '';
                                    ?>
                                    <option value="<?= $vehicleModel['id'] ?>" <?= $selected ?>><?= $vehicleModel['model_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_chasis_number" class="form-label">Vehicle chassis number</label>
                            <input type="text" class="form-control" id="vehicle_chasis_number" name="vehicle_chasis_number" value="<?= $singleRegistration['chassis_number'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_registration_number" class="form-label">Vehicle registration number</label>
                            <input type="text" class="form-control" id="vehicle_registration_number" name="vehicle_registration_number" value="<?= $singleRegistration['registration_number'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="registration_to" class="form-label">Registration to</label>
                            <input type="date" class="form-control" id="registration_to" name="registration_to" value="<?= $singleRegistration['registration_to'] ?>">
                        </div>
                    </div>
                    <div class="col-6 d-flex flex-column justify-content-between">
                        <div class="mb-3">
                            <label for="vehicle_type" class="form-label">Vehicle type</label>
                            <select name="vehicle_type" id="vehicle_type" class="form-control">
                                <?php
                                    foreach($vehicleTypes as $vehicleType){ 
                                        $selected = ($vehicleType['id'] == $singleRegistration['vehicle_type_id']) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $vehicleType['id'] ?>" <?= $selected ?>><?= $vehicleType['type_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Vehicle_production_year" class="form-label">Vehicle production year</label>
                            <input type="date" class="form-control" id="Vehicle_production_year" name="vehicle_production_year" value="<?= $singleRegistration['production_year'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="fuel_type" class="form-label">Fuel type</label>
                            <select name="fuel_type" id="fuel_type" class="form-control">
                                <?php
                                    foreach ($fuelTypes as $fuelType) {
                                        $selected = ($fuelType['id'] == $singleRegistration['fuel_type_id']) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $fuelType['id'] ?>" <?= $selected ?>><?= $fuelType['fuel_type'] ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="text-center">
            <a href="./dashboard.php" class="btn-lg btn-danger text-decoration-none"><i class="fas fa-arrow-left me-2"></i> Go back</a>
        </div>
</div>
</body>
</html>