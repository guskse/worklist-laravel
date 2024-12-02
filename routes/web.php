<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;


//HOME PAGE
Route::get('/', [HomeController::class, 'index'])->name('home');

//JOBS ROUTES
Route::resource('jobs', JobController::class);



//REGISTER ROUTES
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

//LOGIN ROUTES
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

//LOGOUT ROUTE
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
