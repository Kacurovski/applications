<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expired Link</title>
</head>
<body>
    <h1>Expired Link</h1>
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <form action="{{ route('regenerate.new.link', $user) }}" method="POST">
        @csrf
        <button type="submit">Resend Activation Link</button>
    </form>
</body>
</html>