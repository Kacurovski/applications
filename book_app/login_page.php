<?php
session_start();

require_once('./php/functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/login_page.css">
  <link rel="stylesheet" href="./css/global.css">
</head>

<body>
  <header class="bg-secondary fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center w-75">
      <a href="/book_app"><img src="./assets/images/brainster-logo.png" alt="brainster logo" class="logo_img"></a>
    </div>
  </header>
  <div class="login-form-section container-fluid row vh-100 align-items-center">
    <div class="form_holder col-md-4 offset-md-3">
      <h1 class="text-center text-light display-3 fw-bold mb-5">Log In</h1>
      <form method="POST" action="/book_app/verify_user" class="mb-3 text-light edit-table-form" id="login_user_form">
        <div class="mb-3">
          <label for="login_email" class="form-label fw-bold h5">Email: <span class="text-dark fw-normal h6">( required )</span></label>
          <input type="email" class="form-control rounded-pill py-2 px-3" name="email" id="login_email" aria-describedby="emailHelp">
          <span class="input-error text-dark fw-bold"></span>
        </div>
        <div class="mb-3">
          <label for="login_password" class="form-label fw-bold h5">Password: <span class="text-dark fw-normal h6">( required )</span></label>
          <input type="password" class="form-control rounded-pill py-2 px-3" name="password" id="login_password">
          <span class="input-error text-dark fw-bold"></span>
        </div>

        <?php displayMessage(); ?>
        
        <div>
          <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2">Log In</button>
        </div>
      </form>
      <p class="text-center text-light h5">Already have a profile ? <a href="./signup" class="text-warning fw-bold">Sign Up !</a></p>
    </div>
  </div>
  <?php include ('./php/templates/footer.php')?>

  <script src="./javascript/functions/functions.js"></script>  
  <script src="./javascript/footer_api.js"></script>
  <script src="./javascript/validations/forms_validations.js"></script>
</body>

</html>