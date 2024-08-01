<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
// login

// // register
// Route::get('register', [RegisterController::class, 'index'])->name('register');
// Route::post('register', [RegisterController::class, 'store']);
// // end register

// logout
Route::post('logout', [LoginController::class, 'destroy'])
    ->name('logout');
Route::get('logout', [LoginController::class, 'destroy'])
    ->name('logout');
// end logout