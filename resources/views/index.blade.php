<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
</head>
<style>
    body {
        position: relative;
    }

    body::before {
        content: '';
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: -1;
        background-color: black;
        background-image: url('../images/background-image.jpg');
        background-size: cover;
        opacity: 0.9;
    }


    .nav,
    footer {
        position: relative;
        z-index: 1;
    }

    .nav::before,
    footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #200000;
        opacity: 0.7;
        z-index: -1;
    }

    .transparent-background {
        background-color: white !important;
        opacity: 0.8 !important;
    }
</style>

<body>
    @php
    $userData = request()->session()->get('user_data');
    $name = isset($userData['name']) ? $userData['name'] : 'YOU';
    $surname = isset($userData['surname']) ? $userData['surname'] : '';
    @endphp
    <section class="main-section container-fluid vh-100 py-4 px-0">
        <h1 class="text-uppercase text-light display-2 fw-normal text-center pt-5 mb-5">Business Casual</h1>
        <div class="nav d-flex justify-content-center py-3 my-5">
            <a href="{{ route('home') }}" class="text-uppercase text-decoration-none me-3 mb-0 h3 {{ request()->routeIs('home') ? 'text-warning' : 'text-light' }}">Home</a>
            <a href="{{ route('user.create') }}" class="text-uppercase text-decoration-none me-3 mb-0 h3 {{ request()->routeIs('user.create') ? 'text-warning' : 'text-light' }}">Log In</a>
            @if($userData)
            <form action="{{ route('clear.session') }}" method="POST">
                @csrf
                <button type="submit" class="h3 text-uppercase text-light bg-transparent border-0 p-0 mb-0">Log Out</button>
            </form>
            @endif
        </div>
        <div class="row position-relative">
            <div class="col-4 offset-2 position-absolute align-self-center bg-transparent transparent-background text-center p-4 my-auto order-2 order-md-1">
                <p class="h2 fw-normal">Lorem Ipsum</p>
                <p class="h1 fw-normal mb-4">Lorem Ipsum</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi totam deleniti necessitatibus ad ducimus. Ratione, adipisci earum. Incidunt ullam impedit eos sint pariatur distinctio necessitatibus, minus, culpa nulla facilis.</p>
                <div class="position-relative">
                    <button class="btn btn-warning text-dark fw-bold position-absolute start-50 mt-4 translate-middle">Visit us Today</button>
                </div>
            </div>
            <div class="col-5 offset-5 order-1 order-md-2">
                <div class="about-us mx-auto">
                    <img src="../images/catalyst-cafe.jpg" alt="" class="w-100">
                </div>
            </div>
        </div>

    </section>
    <div class="bg-warning row py-5">
        <div class="text-center col-8 offset-2 bg-light text-dark p-1">
            <div class="border border-4 border-warning p-3">
                <p class="h5 fw-normal mb-4">Our promise</p>
                <p class="h3 fw-normal mb-4">To {{ $name }} {{ $surname }}</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus consectetur quibusdam cumque illum maxime voluptatum veritatis officiis nobis adipisci! Hic voluptatibus pariatur iusto odit nisi facere magni, deleniti, consectetur adipisci animi iste unde delectus nihil! Ratione quibusdam eveniet saepe nesciunt, voluptate ab laboriosam labore fugit est recusandae, assumenda architecto nostrum eum eaque aliquid omnis! At iste natus earum illo laudantium facilis veniam voluptatem reiciendis quis aspernatur minus esse error excepturi aliquam voluptatum, aperiam impedit. Quo totam accusantium id esse porro.</p>
            </div>
        </div>
    </div>
    <footer class="text-center text-light py-4">
        <p class="m-0">Copyright © Your Website 2018</p>
    </footer>
</body>

</html>