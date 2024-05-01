<?php

session_start();

include_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
    die();
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$_SESSION['usernamePreFill'] = $username;

$fullData = dataExplode();

$loggedIn = false;

foreach ($fullData as $key => $value) {
    if ($value['username'] === $username && password_verify($password, $value['password'])) {
        $loggedIn = true;
        $_SESSION['username'] = $username;
        break;
    }
}

if ($loggedIn) {
    redirect('welcome.php');
} else {
    redirect('login.php?wrongCombination=Wrong%20username/password%20combination');
}

?>