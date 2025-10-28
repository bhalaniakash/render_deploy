<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            padding: 20px;
        }
    </style>
</head>

<body>
    <h1>Register</h1>

    @if ($errors->any())
        <div style="color:red">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div>
            <label>Name</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Confirm Password</label><br>
            <input type="password" name="password_confirmation" required>
        </div>
        <div style="margin-top:10px">
            <button type="submit">Register</button>
        </div>
    </form>

    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
</body>

</html>
