<?php 
include ('./connection.php');
$users = "SELECT * FROM `form-info`";
$allUsers = mysqli_query($connection, $users);

if(isset($_COOKIE['submitedForm'])){
  $dataMessage = 'Формата е успешно пополнета';
}
else{
  $dataMessage = 'Добредојдовте назад';
}

if(mysqli_num_rows($allUsers) > 0){
    $dataUsers = array();
    while($rowUsers = mysqli_fetch_assoc($allUsers)){
        $dataUsers[] = $rowUsers;
    }
}
else{
    $noContacts = "Нема контакти кои ја имаат успешно пополнето формата";
}
mysqli_close($connection);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/style.css" />
    <script src="https://kit.fontawesome.com/66e5d91f72.js" crossorigin="anonymous"></script>

    <!-- BOOTSTRAP CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Brainster</title>
  </head>
  <body>  
  <header>
      <nav class="navbar navbar-expand-lg bg-yellow bg-dark-custom text-light px-5 py-4">
        <a class="navbar-brand text-center p-0" href="./index.php">
          <img src="./images/Logo.png" alt="picture of the logo">
          <p class="fw-bold small m-0 ">Brainster</p>
        </a>
        <button id="navbarToggler" class="navbar-toggler border-0 p-0" type="button">
          <img src="./images/hamburgerMenu.png" alt="image of the responsive menu">
        </button>
        <div class="collapse navbar-collapse mt-4 mt-lg-0" id="navbarSupportedContent">
          <ul class="navbar-nav hover-effect ms-auto mb-2 mb-lg-0">
            <li class="nav-item fw-bold mx-lg-4 mb-3 mb-lg-0">
              <a class="nav-link text-dark text-dark" aria-current="page" href="https://brainster.co/marketing/">Академија за маркетинг</a>
            </li>
            <li class="nav-item fw-bold me-4 mb-3 mb-lg-0">
              <a class="nav-link text-dark" href="https://brainster.co/full-stack/">Академија за програмирање</a>
            </li>
            <li class="nav-item fw-bold me-4 mb-3 mb-lg-0">
              <a class="nav-link text-dark" href="https://brainster.co/data-science/">Академија за data-science</a>
            </li>
            <li class="nav-item fw-bold me-4 mb-3 mb-lg-0">
              <a class="nav-link text-dark" href="https://brainster.co/graphic-design/">Академија за дизајн</a>
            </li>
          </ul>
          <a href="#" class="btn btn-danger fw-bold px-3" data-bs-toggle="modal" data-bs-target="#formModal">Вработи наш студент</a>
        </div>
        <!-- Modal Form-->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content bg-warning">
              <div class="modal-header justify-content-center border-0 mb-5">
                <p class="modal-title display-2 text-center fw-bold text-dark" id="formModalLabel">Вработи Студенти</p>
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body border-0">
                <?php include('./form.php');?>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Mobile Menu-->
        <div class="modal fade" id="mobileModal" tabindex="-1" aria-labelledby="mobileModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-fullscreen">
            <div class="modal-content bg-dark text-light">
              <div class="modal-header border-0">
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <ul class="navbar-nav hover-effect mb-3">
                    <li class="nav-item fw-bold mb-3">
                      <a class="nav-link text-light" aria-current="page" href="https://brainster.co/marketing/">Академија за маркетинг</a>
                    </li>
                    <li class="nav-item fw-bold mb-3">
                      <a class="nav-link text-light" href="https://brainster.co/full-stack/">Академија за програмирање</a>
                    </li>
                    <li class="nav-item fw-bold mb-3">
                      <a class="nav-link text-light" href="https://brainster.co/data-science/">Академија за data-science</a>
                    </li>
                    <li class="nav-item fw-bold mb-3">
                      <a class="nav-link text-light" href="https://brainster.co/graphic-design/">Академија за дизајн</a>
                    </li>
                  </ul>
                  <a href="#" class="btn btn-danger fw-bold px-3" data-bs-toggle="modal" data-bs-target="#formModal" id="modalButton">Вработи наш студент</a>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </header>

      <div>
      <?php if (!empty($dataUsers)) : ?>
          <div class="container-fluid vh-100 bg-warning pt-5">
            <div class="form-submit-div mb-5">
              <p class="display-2 fw-bold text-success text-center">
              <?php 
              echo $dataMessage;
              ?>
              <i class="fa-solid fa-check fa-lg"></i></p>
              <div class="d-flex justify-content-center">
                <a href="./index.php" class="btn btn-danger fw-bold">Врати се назад</a>
              </div>
            </div>
              <div class="table-holder row">
                <div class="table-inner col-12 col-lg-8 offset-lg-2 d-flex flex-column">
                  <p class="fs-2 text-center">Контакти кои ја имаат успешно пополнето формата:</p>
                  <div class="overflow-auto table-div">
                  <table class="table table-light table-striped table-hover table-bordered">
                      <thead class="fw-bold">
                        <tr class="h5">
                          <th scope="col">Име и презиме</th>
                          <th scope="col">Име на компанија</th>
                          <th scope="col">Контакт имејл</th>
                          <th scope="col">Контакт Телефон</th>
                          <th scope="col">Тип на студент</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <?php foreach ($dataUsers as $row) : ?>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['companyName']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['tel']; ?></td>
                          <td><?php echo $row['studentType']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
          <?php else : ?>
              <div class="vh-100 bg-warning pt-5">
              <p class="text-center h1"><?php echo $noContacts?></p>
              <div class="d-flex justify-content-center">
                <a href="./index.php" class="btn btn-danger fw-bold mt-4">Врати се назад</a>
              </div>
              </div>
          <?php endif; ?>
        </div>



    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var navbarToggler = document.getElementById("navbarToggler");
        var mobileModal = document.getElementById("mobileModal");
        var navbarCollapse = document.getElementById("navbarSupportedContent");

        navbarToggler.addEventListener("click", function() {
          if (window.innerWidth < 500) {
            navbarCollapse.classList.remove("show");

            var bsModal = new bootstrap.Modal(mobileModal);
            bsModal.show();
          } else {
            navbarCollapse.classList.toggle("show");
          }
        });
      });
    </script>




    <!-- POPPERJS LINK  -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    <!-- BOOTSTRAP JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
