<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/66e5d91f72.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
<section class="@yield('section-class', 'default-section')">
    <nav class="w-75 mx-auto d-flex justify-content-between custom-gray-color pt-3">
        <div>
            <a href="{{ route('home') }}" class="h4 text-decoration-none text-white fw-bold">Blog</a>
        </div>
        <div>
            <a href="{{ route('home') }}" class="text-uppercase me-3 h5 text-decoration-none fw-bold {{ request()->routeIs('home') ? 'text-white' : 'custom-gray-color' }}">Home</a>
            <a href="{{ route('about') }}" class="text-uppercase me-3 h5 text-decoration-none fw-bold {{ request()->routeIs('about') ? 'text-white' : 'custom-gray-color' }}">About</a>
            <a href="{{ route('blog') }}" class="text-uppercase me-3 h5 text-decoration-none fw-bold {{ request()->routeIs('blog') ? 'text-white' : 'custom-gray-color' }}">Sample Post</a>
            <a href="{{ route('contact') }}" class="text-uppercase h5 text-decoration-none fw-bold {{ request()->routeIs('contact') ? 'text-white' : 'custom-gray-color' }}">Contact</a>
        </div>
    </nav>
    <div class="about-text d-flex flex-column justify-content-center align-items-center h-100 col-4 mx-auto px-2 text-light">
        <h1 class="fw-bold mb-4 {{ request()->routeIs('blog') ? 'h1' : 'display-4' }}">@yield('page-title')</h1>
        @if(request()->routeIs('blog'))
        <h2 class="h2 custom-gray-color mb-4">@yield('page-subtitle')</h2>
        @endif
        <p class="h5 custom-gray-color {{ request()->routeIs('blog') ? 'me-auto' : '' }}">@yield('page-description')</p>
    </div>
</section>