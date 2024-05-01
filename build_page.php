<?php
session_start();

$old_values = [
    'cover_image_url' => '',
    'title' => '',
    'subtitle' => '',
    'description' => '',
    'telephone' => '',
    'location' => '',
    'content_type' => 'services',
    'content_one_url' => '',
    'content_one_description' => '',
    'content_two_url' => '',
    'content_two_description' => '',
    'content_three_url' => '',
    'content_three_description' => '',
    'contact_description' => '',
    'linkedin_url' => '',
    'facebook_url' => '',
    'twitter_url' => '',
    'google_plus_url' => '',
];

if (isset($_SESSION['old_values'])) {
    $old_values = array_merge($old_values, $_SESSION['old_values']);
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
        .main_section_builder {
            background-image: url(./assets/images/build_page.jpg);
            background-position: center;
            background-size: cover; 
            min-height: 100vh    
        }
    </style>
</head>
<body>
    <div class="container-fluid main_section_builder">
        <div class="row">
            <div class="col-10 offset-1">
                <h1 class="display-5 fw-bold text-center pt-3 pb-4">You are one step away from your webpage</h1>
                <?php
                    if(isset($_SESSION['message'])){
                        echo $_SESSION['message'];
                        session_destroy();
                    }
                ?>
                <form action="create_page.php" method="POST">
                    <div class="row">
                        <div class="col-4">
                            <div class="d-flex flex-column bg-light p-4 rounded">
                                <label for="cover_image_url" class="h6">Cover image URL</label>
                                <input type="text" name="cover_image_url" id="cover_image_url" class="form-control mb-4" value="<?php echo htmlspecialchars($old_values['cover_image_url']); ?>">

                                <label for="title" class="h6">Main Title of Page</label>
                                <input type="text" name="title" id="title" class="form-control mb-4" value="<?php echo htmlspecialchars($old_values['title']); ?>">

                                <label for="subtitle" class="h6">Subtitle of Page</label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control mb-4" value="<?php echo htmlspecialchars($old_values['subtitle']); ?>">

                                <label for="description" class="h6">Something about you</label>
                                <input type="text" name="description" id="description" class="form-control mb-4" value="<?php echo htmlspecialchars($old_values['description']); ?>">

                                <label for="telephone" class="h6">Your telephone number</label>
                                <input type="text" name="telephone" id="telephone" class="form-control mb-4" value="<?php echo htmlspecialchars($old_values['telephone']); ?>">

                                <label for="location" class="h6">Location</label>
                                <input type="text" name="location" id="location" class="form-control mb-4" value="<?php echo htmlspecialchars($old_values['location']); ?>">

                                <label for="select" class="h6">Do you provide services or products</label>
                                <select name="content_type" id="select" class="p-2">
                                    <option value="services">Services</option>
                                    <option value="products">Products</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex flex-column bg-light p-4 rounded">
                                <p class="h5 mb-4">Provide url for an image and description of your service/product</p>

                                <label for="content_one_url" class="h6">Image URL</label>
                                <input type="text" name="content_one_url" id="content_one_url" class="form-control mb-4" value="<?php echo htmlspecialchars($old_values['content_one_url']); ?>">

                                <label for="content_one_description" class="h6">Description of service/product</label>
                                <textarea name="content_one_description" id="content_one_description" cols="30" rows="2" class="form-control mb-4"><?php echo htmlspecialchars($old_values['content_one_description']); ?></textarea>

                                <label for="content_two_url" class="h6">Image URL</label>
                                <input type="text" name="content_two_url" id="content_two_url" class="form-control mb-4" value="<?php echo htmlspecialchars($old_values['content_two_url']); ?>">

                                <label for="content_two_description" class="h6">Description of service/product</label>
                                <textarea name="content_two_description" id="content_two_description" cols="30" rows="2" class="form-control mb-4"><?php echo htmlspecialchars($old_values['content_two_description']); ?></textarea>

                                <label for="content_three_url" class="h6">Image URL</label>
                                <input type="text" name="content_three_url" id="content_three_url" class="form-control mb-4" value="<?php echo htmlspecialchars($old_values['content_three_url']); ?>">

                                <label for="content_three_description" class="h6">Description of service/product</label>
                                <textarea name="content_three_description" id="content_three_description" cols="30" rows="2" class="form-control"><?php echo htmlspecialchars($old_values['content_three_description']); ?></textarea>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex flex-column bg-light p-4 rounded">
                                <p class="h5 mb-4">Provide a description of your company, something people should be aware of before they contact you:</p>
                                <textarea name="contact_description" id="contact_description" cols="30" rows="2" class="form-control mb-4"><?php echo htmlspecialchars($old_values['contact_description']); ?></textarea>

                                <hr>

                                <label for="linkedin_url" class="h5">Linkedin</label>
                                <input type="text" name="linkedin_url" id="linkedin_url" class="form-control mb-4" value="<?php echo htmlspecialchars($old_values['linkedin_url']); ?>">

                                <label for="facebook_url" class="h5">Facebook</label>
                                <input type="text" name="facebook_url" id="facebook_url" class="form-control mb-4" value="<?php echo htmlspecialchars($old_values['facebook_url']); ?>">

                                <label for="twitter_url" class="h5">Twitter</label>
                                <input type="text" name="twitter_url" id="twitter_url" class="form-control mb-4" value="<?php echo htmlspecialchars($old_values['twitter_url']); ?>">

                                <label for="google_plus_url" class="h5">Google+</label>
                                <input type="text" name="google_plus_url" id="google_plus_url" class="form-control" value="<?php echo htmlspecialchars($old_values['google_plus_url']); ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn-lg btn-secondary my-4 w-50 m-auto">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>