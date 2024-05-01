<!-- show.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

        .about-us {
            width: 700px;
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
    </style>
</head>

<body>
    <div class="container-fluid vh-100 d-flex flex-column px-0">
        <h1 class="text-uppercase text-light display-2 fw-normal text-center pt-5 mb-5">Business Casual</h1>
        <div class="nav d-flex justify-content-center py-3 my-5">
            <a href="{{ route('home') }}" class="text-uppercase text-light text-decoration-none me-3 mb-0 h3">Home</a>
            <a href="{{ route('user.create') }}" class="text-uppercase text-light text-decoration-none me-3 mb-0 h3">Log In</a>
            @if($data)
            <form action="{{ route('clear.session') }}" method="POST">
                @csrf
                <button type="submit" class="h3 text-uppercase text-light bg-transparent border-0 p-0 mb-0">Log Out</button>
            </form>
            @endif
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <div class="text-light">
                    <p class="h2">Your Name: {{ $data['name'] }}</p>
                    <p class="h2">Your Surname: {{ $data['surname'] }}</p>
                    @isset($data['email'])
                    <p class="h2">Your Email: {{ $data['email'] }}</p>
                    @endisset
                </div>
            </div>
        </div>
        <footer class="text-center text-light py-3 mt-auto">
            <p class="m-0">Copyright © Your Website 2018</p>
        </footer>
    </div>
</body>

</html>