<?php

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    session_start();
    require_once('autoload.php');

    if(inputValidation($_POST)){
        
        $selector = new Selector;

        $searchResult = $selector->searchCriteria($_POST['criteria']);
        
        if(empty($searchResult)){
            $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">There is no such record</p></div>';
            header('location:dashboard.php');
            exit;
        }   
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Enter model, license plate number or chassis number</p></div>';
        header('location:dashboard.php');
        exit;
    }
} else {
    header('location:dashboard.php');
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
    <div class="container">
        <h1 class="fw-bold text-center my-5">Search Result:</h1>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php                   
                $rowNumber = 1;
                foreach ($searchResult as $res) { 
                    $registrationToDate = new DateTime($res['registration_to']);
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
                        <td><?= $res['vehicle_model'] ?></td>
                        <td><?= $res['vehicle_type'] ?></td>
                        <td><?= $res['chassis_number'] ?></td>
                        <td><?= $res['production_year'] ?></td>
                        <td><?= $res['registration_number'] ?></td>
                        <td><?= $res['fuel_type'] ?></td>
                        <td class="<?= $registrationToClass ?> fw-bold"><?= $res['registration_to'] ?></td>
                        <td class="d-flex">
                        <form action="delete_registration.php" method="POST" class="me-2">
                            <input type="hidden" name="registration_id" value="<?php echo $res['registration_id'] ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <form action="edit_registration.php" method="POST" class="me-2">
                            <input type="hidden" name="registration_id" value="<?php echo $res['registration_id'] ?>">
                            <button type="submit" class="btn btn-warning">Edit</button>
                        </form>
                        <?php
                            if($dateDifference <= 30){ ?>
                                <form action="extend_registration.php" method="POST">
                                    <input type="hidden" name="registration_id" value="<?php echo $res['registration_id'] ?>">
                                    <button type="submit" class="btn btn-success" name="extend">Extend</button>
                                </form>
                        <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="text-center">
            <a href="./dashboard.php" class="btn-lg btn-danger text-decoration-none"><i class="fas fa-arrow-left me-2"></i> Go back</a>
        </div>
    </div>
</body>
</html>