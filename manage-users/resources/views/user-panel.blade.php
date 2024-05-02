<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>

    <div class="d-flex flex-column align-items-center">
        <h1 class="text-primary p-3">Welcome {{ Auth::user()->username; }}</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-warning font-weight-bold mx-auto">Profile Dashboard</a>
    </div>
</body>

</html>