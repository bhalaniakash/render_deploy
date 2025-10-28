@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <h2>Create an account</h2>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}" data-validate="password-match">
        @csrf
        <div class="field">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="field">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="field">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div class="field">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <div style="margin-top:10px">
            <button type="submit">Register</button>
        </div>
    </form>

    <p class="small">Already have an account? <a href="{{ route('login') }}">Login</a></p>
@endsection
