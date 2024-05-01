<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    require_once __DIR__ . '/autoload_classes.php';
    require_once __DIR__ . '/functions.php';
    if(inputValidation($_POST)){
        $params = [
            'cover_image_url' => $_POST['cover_image_url'],
            'title' => $_POST['title'],
            'subtitle' => $_POST['subtitle'],
            'description' => $_POST['description'],
            'telephone' => $_POST['telephone'],
            'location' => $_POST['location'],
            'content_type' => $_POST['content_type'],
            'content_one_url' => $_POST['content_one_url'],
            'content_one_description' => $_POST['content_one_description'],
            'content_two_url' => $_POST['content_two_url'],
            'content_two_description' => $_POST['content_two_description'],
            'content_three_url' => $_POST['content_three_url'],
            'content_three_description' => $_POST['content_three_description'],
            'contact_description' => $_POST['contact_description'],
            'linkedin_url' => $_POST['linkedin_url'],
            'facebook_url' => $_POST['facebook_url'],
            'twitter_url' => $_POST['twitter_url'],
            'google_plus_url' => $_POST['google_plus_url']
        ];

        $page = new Page();

        $lastInsertId = $page->createPage($params);

        $_SESSION['message'] = '<div class="alert alert-success mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Page succesfully created</p></div>';

        header("Location:page_template.php?id=$lastInsertId");

        exit;
    } else {
        $_SESSION['old_values'] = $_POST;
        $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Pls full up all the fields</p></div>';
    }
}
header("Location:build_page.php");