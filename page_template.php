<?php

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    require_once('autoload_classes.php');

    $id = $_GET['id'];
    $page = new Page;
    $allPages = $page->getAllPages();

    foreach($allPages as $dataPage){
        if($dataPage['id'] == $id){
            $singlePage = $page->getSinglePage($id);
            break;
        }
    }

    if ($singlePage == null) {
        header('location:index.php');
        exit;
    }

} else {
    header('location:index.php');
    exit;
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
        .main_section_template {
            background-image: url(<?php echo $singlePage['cover_image_url'] ?>);
            background-position: center;
            background-size: cover;
            height: 50vh;
        }
        .text_with_shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }
        .navbar-nav .nav-item:hover .nav-link {
            color: #000 !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <a class="navbar-brand" href="page_template.php?id=<?php echo $id ?>"><?php echo $singlePage['title'] ?></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto fw-bold    mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="#main_section">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#about_us">About Us</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#product_type"><?php echo $singlePage['content_type'] ?></a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <section class="main_section_template d-flex flex-column align-items-center justify-content-around text-light" id="main-section">
            <h1 class="text-center text_with_shadow mb-5"><?php echo $singlePage['title'] ?></h1>
            <h2 class="text-center text_with_shadow mb-5"><?php echo $singlePage['subtitle'] ?></h2>
    </section>
    <div class="container py-3" id="about_us">
        <div class="row">
            <div class="col-6 offset-3">
                <h2 class="text-center">About us</h2>
                <p class="text-center"><?php echo $singlePage['description'] ?></p>
                <hr>
                <p class="text-center m-0">Tel: <?php echo $singlePage['telephone'] ?></p>
                <p class="text-center m-0">Location: <?php echo $singlePage['location'] ?></p>
            </div>
        </div>
    </div>
    <section class="container py-3" id="product_type">
        <h2><?php echo $singlePage['content_type'] ?></h2>
        <div class="row">
            <div class="col-4">
            <div class="card bg-dark text-light bg-dark text-light">
                <img src="<?php echo $singlePage['content1_url'] ?>" class="card-img-top" alt="Content one">
                <div class="card-body">
                    <h3 class="h4 mb-3"><?php echo $singlePage['content_type'] === 'Services' ? 'Service' : 'Product' ?> One Description</h3>
                    <p class="card-text"><?php echo $singlePage['content1_description'] ?></p>
                    <p>Last updated 3 mins ago</p>
                </div>
            </div>
            </div>
            <div class="col-4">
            <div class="card bg-dark text-light">
                <img src="<?php echo $singlePage['content2_url'] ?>" class="card-img-top" alt="Content two">
                <div class="card-body">
                    <h3 class="h4 mb-3"><?php echo $singlePage['content_type'] === 'Services' ? 'Service' : 'Product' ?> Two Description</h3>
                    <p class="card-text"><?php echo $singlePage['content2_description'] ?></p>
                    <p>Last updated 3 mins ago</p>
                </div>
            </div>
            </div>
            <div class="col-4">
            <div class="card bg-dark text-light">
                <img src="<?php echo $singlePage['content3_url'] ?>" class="card-img-top" alt="Content three">
                <div class="card-body">
                    <h3 class="h4 mb-3"><?php echo $singlePage['content_type'] === 'Services' ? 'Service' : 'Product' ?> Three Description</h3>
                    <p class="card-text"><?php echo $singlePage['content3_description'] ?></p>
                    <p>Last updated 3 mins ago</p>
                </div>
            </div>
            </div>
        </div>
    </section>
    <div class="container py-3" id="contact">
        <div class="row">
            <div class="col-6">
                <h2>Contact</h2>
                <p><?php echo $singlePage['contact_description'] ?></p>
            </div>
            <div class="col-6">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-light d-flex flex-column align-items-center py-2">
        <p>Copyright by Kristijan @ Brainster</p>
        <div class="h5">
            <a href="<?php echo $singlePage['linkedin_url'] ?>" target="_blank" class="text-decoration-none">Linkedin</a>
            <a href="<?php echo $singlePage['facebook_url'] ?>" target="_blank" class="text-decoration-none">Facebook</a>
            <a href="<?php echo $singlePage['twitter_url'] ?>" target="_blank" class="text-decoration-none">Twitter</a>
            <a href="<?php echo $singlePage['google_plus_url'] ?>" target="_blank" class="text-decoration-none">Google+</a>
        </div>
    </footer>
</body>
</html>