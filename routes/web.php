<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('home');
})->middleware('auth');

// add routes for authentication
Route::post('/register', [auth::class, 'register'])->name('register');
Route::get('/register', [auth::class, 'registerForm']);
Route::post('/login', [auth::class, 'login'])->name('login');
Route::get('/login', [auth::class, 'loginForm']);