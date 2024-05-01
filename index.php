<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">Vehicle Registration</a>
            <a href="./login.php" class="btn btn-lg btn-outline-primary fs-6 fw-bold">login</a>
        </div>
    </nav>
    <div class="container">
                <?php
            session_start();
            if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
        } ?>
        <h1 class="text-center">Vehicle Registration</h1>
        <p class="text-center">Enter your registration number to check its validity</p>
        <form action="license_plate.php" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" id="license_plate" name="license_plate">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
</body>
</html>