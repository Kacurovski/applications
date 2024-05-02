<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hi {{ $username }}</h1>
    <h2>To activate your account click on this link: <a href="{{ $activationLink }}">Activation Link</a></h2>
</body>
</html>