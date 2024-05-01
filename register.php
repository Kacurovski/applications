<?php

session_start();

include_once('functions.php');


$usernamePrefill = $_SESSION['usernamePreFill'] ?? '';
$emailPrefill = $_SESSION['emailPreFill'] ?? '';

$usernameError = $passwordError = $emailError = '';



if(isset($_SESSION['errors'])){
  
    $usernameError = errorGenerator($_SESSION['errors']['username']) ?? '';
    $passwordError = errorGenerator($_SESSION['errors']['password']) ?? '';
    $emailError = errorGenerator($_SESSION['errors']['email']) ?? '';

    unset($_SESSION['errors']);
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .container-fluid{
            background-image: url(./img/register.jpg);
            background-position: center;
            background-size: cover;
        }
    .formHolder{
        width: 40%;
    }
    .btn{
        width: 100px;
    }
    </style>
</head>
<body>
    <div class="container-fluid d-flex align-items-center flex-column vh-100">
        <h1 class="text-center display-1 fw-bold my-5">Sign Up Form</h1>
            <div class="formHolder mt-5">
                <form action="registerUser.php" method="POST"> 
                <div class="mb-3">
                    <label for="username" class="form-label h3">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $usernamePrefill ?? '' ?>" aria-describedby="usernameHelp">
                    <?php echo $usernameError ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label h3">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
                    <?php echo $passwordError ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label h3">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $emailPrefill ?? '' ?>" aria-describedby="usernameHelp">
                    <?php echo $emailError ?>
                </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                    <a href="./index.php" class="btn btn-danger">Back</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>