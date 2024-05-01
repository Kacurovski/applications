<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
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
    <div class="container-fluid vh-100 d-flex flex-column pt-4 px-0">
        <h1 class="text-uppercase text-light display-2 fw-normal text-center pt-5 mb-5">Business Casual</h1>
        <div class="nav d-flex justify-content-center py-3 mb-5">
            <a href="{{ route('home') }}" class="text-uppercase text-decoration-none me-3 mb-0 h3 {{ request()->routeIs('home') ? 'text-warning' : 'text-light' }}">Home</a>
            <a href="{{ route('user.create') }}" class="text-uppercase text-decoration-none me-3 mb-0 h3 {{ request()->routeIs('user.create') ? 'text-warning' : 'text-light' }}">Log In</a>
        </div>
        <div class="row">
            <div class="col-6 offset-3">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        @error('name')
                        <p class="bg-danger text-light p-1 m-0">{{ $message }}</p>
                        @enderror
                        <label for="name" class="form-label text-uppercase text-light fw-bold h5">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        @error('surname')
                        <p class="bg-danger text-light p-1 m-0">{{ $message }}</p>
                        @enderror
                        <label for="surname" class="form-label text-uppercase text-light fw-bold h5">Surname</label>
                        <input type="text" class="form-control" name="surname" id="surname" value="{{ old('surname') }}">
                    </div>
                    <div class="mb-3">
                        @error('email')
                        <p class="bg-danger text-light p-1 m-0">{{ $message }}</p>
                        @enderror
                        <label for="email" class="form-label text-uppercase text-light fw-bold h5">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <footer class="text-center text-light py-3 mt-auto">
            <p class="m-0">Copyright © Your Website 2018</p>
        </footer>
    </div>
</body>

</html>