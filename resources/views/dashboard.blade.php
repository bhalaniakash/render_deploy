<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            padding: 20px;
        }
    </style>
</head>

<body>
    <h1>Dashboard</h1>

    <p>Welcome, {{ $user->name ?? 'User' }} ({{ $user->email ?? '' }})</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <p><a href="/">Home</a></p>
</body>

</html>
