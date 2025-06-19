<?php

use App\Events\PonyHungry;
use App\Events\PonyReaper;
use App\Http\Controllers\GeneratorController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ItemController;
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
Route::get('/ponyid/{colors}', [PonyController::class, 'ponyTesting'])->name('ponyTester');
Route::get('/pony/image/{ponyid}', [ImageController::class, 'getPony']);
Route::get('/ponyprofile/{ponyid}', [PonyController::class, 'ponyProfile'])->name('pony.profile');
Route::get('/item/{itemID}/{type}', [ImageController::class, 'getItem']);
Route::get('buildpony/layer/{ponyid}/{layer}', [ImageController::class, 'buildPony']);

//AUTHORIZED USER MIDDLEWARE
Route::middleware([LoggedInUser::class])->group(function () {
    //PONY GENERATOR ROUTES
    Route::get('/ponygen/selectbreed', [GeneratorController::class, 'selectBreed']);
    Route::get('/ponygen/generate/{type}', [GeneratorController::class, 'ponyGen']);
    Route::get('/generator/icon/{type}', [ImageController::class, 'getGenIcon']);
    Route::get('/trait/{type}/{traitid}', [ImageController::class, 'getTrait']);
    Route::post('/generate', [GeneratorController::class, 'generatePony'])->name('generate.pony');

    //USER STABLES & ISLAND
    Route::get('/profile/{userID}', [UserController::class, 'myIsland']);
    Route::get('/mystables/{userID}/{order}', [UserController::class, 'myStable']);
    Route::get('/nursery/{userID}', [UserController::class, 'myNursery'])->name('nursery');
    Route::post('/newstable', [UserController::class, 'updateStables'])->name('newstable');
    Route::get('/inventory/{userID}', [UserController::class, 'inventoryOverlay']);
    Route::post('/feedpet', [ItemController::class, 'feedPet']);
});


Route::get('/test', function () {
    event(new PonyHungry());
    event(new PonyReaper());
});
Route::get('/canceloverlay', function () {
    return view('home');
});
