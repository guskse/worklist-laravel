<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;


//HOME PAGE
Route::get('/', [HomeController::class, 'index'])->name('home');

//JOBS ROUTES
// Route::resource('jobs', JobController::class); //without the middleware
Route::resource('jobs', JobController::class)->middleware('auth')->only(['create', 'edit', 'update', 'destroy']);
Route::resource('jobs', JobController::class)->except(['create', 'edit', 'update', 'destroy']);


//all the routes inside the middleware are for guests only
//if an logged in user tries to access these routes, will be redirected to homepage
Route::middleware('guest')->group(function () {
    //REGISTER ROUTES
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    //LOGIN ROUTES
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});


//LOGOUT ROUTE
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
