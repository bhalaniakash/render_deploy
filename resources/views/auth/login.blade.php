@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h2>Sign in to your account</h2>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="field">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="field">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div style="margin-top:10px">
            <button type="submit">Login</button>
        </div>
    </form>

    <p class="small">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
@endsection
