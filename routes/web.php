<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;


//HOME PAGE
Route::get('/', [HomeController::class, 'index']);


//JOBS ROUTES
Route::resource('jobs', JobController::class);
