<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\BookmarkController;



//HOME PAGE
Route::get('/', [HomeController::class, 'index'])->name('home');

//JOBS ROUTES
// Route::resource('jobs', JobController::class); //without middleware
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

//DASHBOARD ROUTE
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

//PROFILE ROUTES
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');


//BOOKMARK ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{job}', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('bookmarks/{job}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});
