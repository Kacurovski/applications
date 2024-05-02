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
          <a href="#" class="btn btn-danger fw-bold px-3" data-bs-toggle="modal" data-bs-target="#formModal" id="modalButton">Вработи наш студент</a>
        </div>
        <!-- Modal Form-->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content bg-warning">
              <div class="modal-header position-relative justify-content-center border-0 mb-5">
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
                  <a href="#" class="btn btn-danger fw-bold px-3" data-bs-toggle="modal" data-bs-target="#formModal">Вработи наш студент</a>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </header>
      <div class="banner-section position-relative overflow-hidden d-flex align-items-center justify-content-center">
      <div class="video-background position-absolute top-0 left-0 w-100 h-100">
        <video autoplay muted loop class="w-100 h-100">
          <source src="./videos/banner-section-video.mp4" type="video/mp4">
        </video>
      </div>
      <div class="banner-content text-center text-light">
        <h1 class="display-1 fw-bold text-shadow-big">Brainster Labs</h1>
      </div>
    </div>
    <div class="container-fluid">
			<div class="row text-white bg-dark">
				<div class="col-lg-4 h4 border-end border-secondary p-0 m-0">
					<label for="filter-marketing" class="p-lg-4 ps-lg-5 p-3 d-flex align-items-center justify-content-between" id="filter-marketing-label">Проекти на студенти по академијата за маркетинг<input type="checkbox" id="filter-marketing" class="toggle-card"> <i class="fa-solid fa-circle-check fa-xl text-dark"></i></label>
				</div>
				<div class="col-lg-4 h4 border-end border-secondary p-0 m-0">
					<label for="filter-coding" class="p-lg-4 ps-lg-5 p-3 d-flex align-items-center justify-content-between" id="filter-coding-label">Проекти на студенти по академијата за програмирање<input type="checkbox" id="filter-coding" class="toggle-card"> <i class="fa-solid fa-circle-check fa-xl text-dark"></i></label>
				</div>
				<div class="col-lg-4 h4 border-end border-secondary p-0 m-0">
					<label for="filter-design" class="p-lg-4 ps-lg-5 p-3 d-flex align-items-center justify-content-between" id="filter-design-label">Проекти на студенти по академијата за дизајн<input type="checkbox" id="filter-design" class="toggle-card"> <i class="fa-solid fa-circle-check fa-xl text-dark ms-5"></i></label>
				</div>
			</div>
		</div>
		<div class="container-fluid bg-warning py-5">
			<div class="row">
        <div class="col-lg-8 offset-lg-2 offset-1 col-10">
          <h2 class="text-center display-3 fw-bold mb-5 ">Проекти</h2>
          <div class="row">
            <div class="col-12 col-lg-4 col-md-6 marketing-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/marketing-project01.jpg" class="card-img-top" alt="image from the marketing project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за маркетинг</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 marketing-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/marketing-project02.jpg" class="card-img-top" alt="image from the marketing project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за маркетинг</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 marketing-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/marketing-project03.jpg" class="card-img-top" alt="image from the marketing project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за маркетинг</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 marketing-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/marketing-project04.jpg" class="card-img-top" alt="image from the marketing project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за маркетинг</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 marketing-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/marketing-project05.jpg" class="card-img-top" alt="image from the marketing project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за маркетинг</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 marketing-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/marketing-project06.jpg" class="card-img-top" alt="image from the marketing project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за маркетинг</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 coding-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/coding-project01.jpg" class="card-img-top" alt="image from the coding project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за програмирање</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 coding-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/coding-project02.jpg" class="card-img-top" alt="image from the coding project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за програмирање</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 coding-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/coding-project03.jpg" class="card-img-top" alt="image from the coding project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за програмирање</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 coding-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/coding-project04.jpg" class="card-img-top" alt="image from the coding project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за програмирање</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 coding-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/coding-project05.jpg" class="card-img-top" alt="image from the coding project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за програмирање</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 coding-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/coding-project06.jpg" class="card-img-top" alt="image from the coding project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за програмирање</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 coding-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/coding-project07.jpg" class="card-img-top" alt="image from the coding project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за програмирање</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 coding-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/coding-project08.jpg" class="card-img-top" alt="image from the coding project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за програмирање</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 coding-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/coding-project09.jpg" class="card-img-top" alt="image from the coding project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за програмирање</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 coding-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/coding-project10.jpg" class="card-img-top" alt="image from the coding project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за програмирање</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 design-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/design-project01.jpg" class="card-img-top" alt="image from the design project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за дизајн</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 design-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/design-project02.jpg" class="card-img-top" alt="image from the design project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за дизајн</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 design-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/design-project03.jpg" class="card-img-top" alt="image from the design project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за дизајн</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6 design-cards cards mb-4">
              <div class="card rounded-4 overflow-hidden shadow">
                <img src="./images/design-project04.jpg" class="card-img-top" alt="image from the design project">
                <div class="card-body">
                  <span class="bg-warning py-1 px-2">Академија за дизајн</span>
                  <h3 class="card-title h4 fw-bold mt-2">Име на проектот стои овде во две линии</h3>
                  <p class="card-text">Краток опис во кој студентите ке опишат за што се работи проектот</p>
                  <p class="small fw-bold mb-4">Април - Октомври 2019</p>
                  <div class="text-end">
                    <a href="#" class="btn btn-danger px-4" target="_blank">Дознај повеќе</a>
                  </div>
                </div>
              </div>
            </div>
					</div>
				</div>
			</div>
		</div>
    <footer class="bg-dark text-light py-3">
      <p class="text-center fw-bold m-0">Изработено со <i class="fa-solid fa-heart color-red"></i> од студентите на Brainster</p>
    </footer>
 

<!-- Mobile Menu button -->
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

<!-- Banner animation text -->
    <script>
      window.addEventListener('DOMContentLoaded', function() {
        const bannerContent = document.querySelector('.banner-content');
        bannerContent.classList.add('show');
      });
    </script>

<!-- Card Filters -->
    <script>

    document.querySelector("#filter-coding").addEventListener("change", filterCoding);
    document.querySelector("#filter-design").addEventListener("change", filterDesign);
    document.querySelector("#filter-marketing").addEventListener("change", filterMarketing);

    document.querySelector("#filter-design-label");
    document.querySelector("#filter-marketing-label");



    function filterCoding() {
      hideAllCards();

      if(document.querySelector("#filter-coding").checked) {
        document.querySelector("#filter-coding-label").classList.add('bg-danger');
        var codingCards = document.querySelectorAll(".coding-cards");
        codingCards.forEach(codingCard => {
          codingCard.style.display = "inline-block";
        });

        document.querySelector("#filter-design").checked = false;
        document.querySelector("#filter-marketing").checked = false;
        document.querySelector("#filter-design-label").classList.remove('bg-danger');
        document.querySelector("#filter-marketing-label").classList.remove('bg-danger');

      } else {
        showAllCards();
        document.querySelector("#filter-coding-label").classList.remove('bg-danger');
      }
    }

    function filterDesign() {
      hideAllCards();

      if(document.querySelector("#filter-design").checked) {
        document.querySelector("#filter-design-label").classList.add('bg-danger');
        var designCards = document.querySelectorAll(".design-cards");
        designCards.forEach(designCard => {
          designCard.style.display = "inline-block";
        });

        document.querySelector("#filter-coding").checked = false;
        document.querySelector("#filter-marketing").checked = false;
        document.querySelector("#filter-coding-label").classList.remove('bg-danger');
        document.querySelector("#filter-marketing-label").classList.remove('bg-danger');

      } else {
        showAllCards();
        document.querySelector("#filter-design-label").classList.remove('bg-danger');
      }
    }

    function filterMarketing() {
      hideAllCards();

      if(document.querySelector("#filter-marketing").checked) {
        document.querySelector("#filter-marketing-label").classList.add('bg-danger');
        var marketingCards = document.querySelectorAll(".marketing-cards");
        marketingCards.forEach(marketingCard => {
          marketingCard.style.display = "inline-block";
        });

        document.querySelector("#filter-design").checked = false;
        document.querySelector("#filter-coding").checked = false;
        document.querySelector("#filter-design-label").classList.remove('bg-danger');
        document.querySelector("#filter-coding-label").classList.remove('bg-danger');

      } else {
        showAllCards();
        document.querySelector("#filter-marketing-label").classList.remove('bg-danger');
      }
    }
    

    function hideAllCards() {
      var allCards = document.querySelectorAll(".cards");  

      allCards.forEach(card => {
        card.style.display = "none";
      });
    }

    function showAllCards() {
      var allCards = document.querySelectorAll(".cards");  

      allCards.forEach(card => {
        card.style.display = "inline-block";
      });
    }
    </script>




    <!-- POPPERJS LINK  -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    <!-- BOOTSTRAP JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
