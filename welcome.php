<?php
session_start();
include_once('functions.php');

$username = $_SESSION['username'] ?? '';

if (!$username) {
    redirect('index.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .welcomePage {
            background-image: url(./img/welcome.jpg);
        }

        .btn {
            width: 200px;
        }
    </style>
</head>

<body>
    <section class="welcomePage d-flex align-items-center flex-column vh-100">
        <h1 class="text-white display-1 fw-bold mt-5"> Welcome <?php echo $username ?? '' ?> !</h1>
        <p class="text-warning h3 my-5">Thank you for joining us, let's start your journey</p>
        <a href="./index.php" class="btn btn-danger fw-bold mx-4">Home Page</a>
    </section>

</body>

</html>
