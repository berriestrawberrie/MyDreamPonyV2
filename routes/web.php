<?php

use App\Http\Controllers\GeneratorController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PonyController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LoggedInUser;
use Illuminate\Support\Facades\Route;

//PUBLIC ROUTES NOT REQUIRING LOGIN
Route::get('/', function () {
    return view('home');
});
Route::get('/register', function () {
    return view('signup');
});
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/ponyid/{colors}', [PonyController::class, 'ponyProfile'])->name('ponyProfile');


//AUTHORIZED USER MIDDLEWARE
Route::middleware([LoggedInUser::class])->group(function () {
    //PONY GENERATOR ROUTES
    Route::get('/ponygen/selectbreed', [GeneratorController::class, 'selectBreed']);
    Route::get('/ponygen/generate/{type}', [GeneratorController::class, 'ponyGen']);
    Route::get('/generator/icon/{type}', [ImageController::class, 'getGenIcon']);
    Route::get('/trait/{type}/{traitid}', [ImageController::class, 'getTrait']);
    Route::post('/generate', [GeneratorController::class, 'generatePony'])->name('generate.pony');
});
