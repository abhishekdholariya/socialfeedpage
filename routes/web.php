<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('credentials');
Route::post('/adduser', [RegisterController::class, 'adduser'])->name('adduser');

Route::get('/', function () {return view('index');});
Route::post('/post-list', [PostController::class, 'show'])->name('allpost');
Route::post('/getcomments', [PostController::class, 'getcomments'])->name('getcomments');

Route::group(['middleware' => 'auth'], function () {

// Route::delete('/logout',[LoginController::class,'logout'])->name('logout');
    Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');

    Route::post('/post', [PostController::class, 'addpost'])->name('addpost');


    Route::get('/getpost', [PostController::class, 'show'])->name('getpost');

    Route::post('/profileupdate/{id}', [RegisterController::class, 'profileUpdate'])->name('profileupdate');

// likepost
    Route::post('/likepost', [PostController::class, 'likepost'])->name('likepost');

// commentpost
    Route::post('/commentpost', [PostController::class, 'commentpost'])->name('commentpost');
// getcomments

});
