<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    require_once('autoload.php');
    if(isset($_POST['extend'])){
   
        $selector = new Selector;
    
        $singleRegistration = $selector->selectSingleRegistration($_POST['registration_id']);
    }

    if(isset($_POST['extend_update'])){
        $registration = new Registration;
        $registration->setRegistrationTo($_POST['registration_to']);
        $registration->updateRegistrationDate($_POST['registration_id']);
        header('location:dashboard.php');
    }
} else {
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
    <div class="container">
        <h1 class="text-center fw-bold my-4">Extend registration</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <div class="mb-3">
                <input type="hidden" name="registration_id" value="<?= $singleRegistration['id'] ?>">
                <input type="date" class="form-control" id="registration_to" name="registration_to" value="<?= $singleRegistration['registration_to'] ?>">
                <button type="submit" class="btn btn-lg btn-primary my-2" name="extend_update">Extend</button>
            </div>
        </form>
        <div class="text-center">
            <a href="./dashboard.php" class="btn-lg btn-danger text-decoration-none"><i class="fas fa-arrow-left me-2"></i> Go back</a>
        </div>
    </div>
</body>
</html>