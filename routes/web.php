<?php

use App\Events\PonyHungry;
use App\Events\PonyReaper;
use App\Http\Controllers\BreederController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\ForumController;
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
Route::get('/ponyprofile/{ponyid}', [PonyController::class, 'ponyProfile'])->name('pony.profile');
Route::get('/item/{itemID}/{type}', [ImageController::class, 'getItem']);
Route::get('buildpony/layer/{ponyid}/{layer}', [ImageController::class, 'buildPony']);

//FORUMS
Route::get('/forums', [ForumController::class, 'forumHome']);
Route::get('/forums/{name}/{category_id}', [ForumController::class, 'categoryTopics']);
Route::get('/post/{category}/{topic_id}', [ForumController::class, 'getPost'])->name('topic');
Route::post('/newtopic/{category_id}', [ForumController::class, 'newTopic']);
Route::post('/newpost/{category_id}/{topic_id}/', [ForumController::class, 'newPost']);
Route::get('/editpost/{post_id}', [ForumController::class, 'editPost']);
Route::post('/updatepost/{post_id}', [ForumController::class, 'submitEdit']);


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
    Route::post('/dressPony', [ItemController::class, 'dressPony']);
    Route::get('/nextpony/{stable}/{current}', [PonyController::class, 'nextPony']);
    Route::get('/previouspony/{stable}/{current}', [PonyController::class, 'previousPony']);   
    
    //CONTESTS ROUTES
    Route::get('/contests', [ContestController::class, 'contests'])->name('contest.home');


    //AGE UP PONY TESTING
    Route::post('/ageUp', [PonyController::class, 'agePony']);


    //PONY BREEDING
    Route::post('/prebreed', [BreederController::class, 'preBreed']);
    Route::post('/submitBreed/{type}', [BreederController::class, 'breedPonies']);
});



Route::get('/test', function () {
    event(new PonyHungry());
    event(new PonyReaper());
});
Route::get('/canceloverlay', function () {
    return view('home');
});
