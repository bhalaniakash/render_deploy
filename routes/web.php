<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FinanceController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Authentication routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::get('/finances', [FinanceController::class, 'index'])->middleware('auth')->name('finances.index');
Route::post('/finances', [FinanceController::class, 'store'])->middleware('auth')->name('finances.store');
Route::post('/finances/opening', [FinanceController::class, 'storeOpening'])->middleware('auth')->name('finances.opening');
Route::get('/finances/{id}/edit', [FinanceController::class, 'edit'])->middleware('auth')->name('finances.edit');
Route::put('/finances/{id}', [FinanceController::class, 'update'])->middleware('auth')->name('finances.update');
Route::delete('/finances/{id}', [FinanceController::class, 'destroy'])->middleware('auth')->name('finances.destroy');
