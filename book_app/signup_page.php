<?php
session_start();

require_once('./php/functions.php');

$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : false;

$isLoggedIn = $admin || $user;

$welcomeText = $admin ? 'Welcome Admin' : ($user ? 'Welcome ' . $user['name'] : 'Guest');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/signup_page.css">
  <link rel="stylesheet" href="./css/global.css">
</head>

<body>
  <?php include('./php/templates/header.php') ?>
  <div class="register-form-section container-fluid row vh-100 align-items-center">
    <div class="form_holder col-4 offset-4">
      <h1 class="text-center text-light display-3 fw-bold mb-5">Sign Up</h1>

      <?php displayMessage(); ?>
      
      <form method="POST" action="/book_app/register_user" class="mb-3 text-light edit-table-form" id="register_form">
        <div class="mb-3">
          <label for="register_name" class="form-label fw-bold h5">Name: ( <span class="text-danger fw-normal h6">required</span> )</label>
          <input type="text" name="register_name" class="form-control rounded-pill py-2 px-3" id="register_name" aria-describedby="nameHelp">
          <span class="input-error text-danger fw-bold"></span>
        </div>
        <div class="mb-3">
          <label for="register_surname" class="form-label fw-bold h5">Surname: ( <span class="text-danger fw-normal h6">required</span> )</label>
          <input type="text" name="register_surname" class="form-control rounded-pill py-2 px-3" id="register_surname" aria-describedby="surnameHelp">
          <span class="input-error text-danger fw-bold"></span>
        </div>
        <div class="mb-3">
          <label for="register_email" class="form-label fw-bold h5">Email: ( <span class="text-danger fw-normal h6">required</span> )</label>
          <input type="email" name="register_email" class="form-control rounded-pill py-2 px-3" id="register_email" aria-describedby="emailHelp">
          <span class="input-error text-danger fw-bold"></span>
        </div>
        <div class="mb-3">
          <label for="register_password" class="form-label fw-bold h5">Password: ( <span class="text-danger fw-normal h6">atleast 8 chars and atleast one uppercase letter and one number )</span></label>
          <input type="password" name="register_password" class="form-control rounded-pill py-2 px-3" id="register_password">
          <span class="input-error text-danger fw-bold"></span>
        </div>
        <div>
          <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold py-2">Submit</button>
        </div>
      </form>
      <p class="h5 text-light text-center mt-4">Already have a profile? <a href="./login" class="text-primary fw-bold ms-1">Login here</a></p>
    </div>
  </div>
  <?php include ('./php/templates/footer.php')?>

  <script src="./javascript/footer_api.js"></script>
  <script src="./javascript/functions/functions.js"></script>
  <script src="./javascript/validations/forms_validations.js"></script>
</body>

</html>