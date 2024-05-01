<?php
session_start();


$usernamePreFill = $_SESSION['usernamePreFill'] ?? '';
$wrongCombination = $_GET['wrongCombination'] ?? '';

if($wrongCombination){   
    $loginError = 'Wrong username/password combination'; 
}



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
            background-image: url(./img/login.jpg);
            background-position: center;
            background-size: cover;
        }
    form{
        width: 40%;
    }
    .btn{
        width: 100px;
    }
    </style>
</head>
<body>
    <div class="container-fluid d-flex flex-column justify-content-center vh-100">
        <h1 class="text-center display-1 fw-bold my-4">Login Form</h1>
        <div class="formHolder d-flex justify-content-center">
            <form action="loginUser.php" method="POST">
                <?php if(!empty($loginError)){ ?>
                    <div class="alert alert-danger">
                        <p class="m-0"><?php echo $loginError ?? ''; ?></p>
                    </div>
                <?php } ?>
                <div class="mb-3">
                    <label for="username" class="form-label h3">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" value ="<?php echo $usernamePreFill ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label h3">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="./index.php" class="btn btn-danger">Back</a>
            </form>
        </div>
    </div>
</body>
</html>