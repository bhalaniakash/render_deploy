@extends('layouts.app')

@section('title', 'Dashboard')

@section('topright')
    <a href="/" class="small">Home</a>
@endsection

@section('content')
    <h2>Dashboard</h2>

    <p>Welcome, <strong>{{ $user->name ?? 'User' }}</strong> <span class="small">({{ $user->email ?? '' }})</span></p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

@endsection
