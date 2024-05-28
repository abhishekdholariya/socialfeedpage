<?php

use App\Http\Controllers\ArchivePostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [IndexController::class, 'show'])->name('show');
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/notification', [IndexController::class, 'index'])->name('notification');
Route::post('/post-list', [PostController::class, 'show'])->name('allpost');
Route::post('/getcomments', [PostController::class, 'getcomments'])->name('getcomments');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/adduser', [RegisterController::class, 'store'])->name('adduser');
    
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('credentials');

    Route::get('/forgot',[ForgotPasswordController::class,'show'])->name('forgotpassword');
    Route::post('/forgot',[ForgotPasswordController::class,'store'])->name('forgotpasswordpost');
    Route::get('/resetpassword/{token}',[ForgotPasswordController::class,'reset'])->name('resetpassword');
    Route::post('/resetpasswordpost',[ForgotPasswordController::class,'update'])->name('resetpasswordpost');
});

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::post('/addpost', [PostController::class, 'addpost'])->name('addpost');   
    Route::get('/getpost', [PostController::class, 'show'])->name('getpost');
    Route::post('/profileupdate/{id}', [RegisterController::class, 'update'])->name('profileupdate');

    // likepost
    Route::post('/likepost', [PostController::class, 'likepost'])->name('likepost');

    // commentpost
    Route::post('/commentpost', [PostController::class, 'commentpost'])->name('commentpost');

    // add reply comment
    Route::post('/get-comments', [PostController::class, 'getComments'])->name('comments.get');
    Route::post('/submit-reply', [PostController::class, 'submitReply'])->name('comments.reply');

    //delete post
    Route::delete('/deletepost', [PostController::class, 'deletepost'])->name('deletepost');

    //follow 
    Route::post('/follow', [IndexController::class, 'follow'])->name('follow');
    Route::post('/unfollow', [IndexController::class, 'unfollow'])->name('unfollow');

    Route::get('/notification', [NotificationController::class, 'show'])->name('notification');

    // archive post
    Route::get('/archivepost', [ArchivePostController::class, 'show'])->name('archivepost');
    Route::post('/archivepost', [PostController::class, 'archivepost'])->name('archivepost');
    Route::post('/unarchivepost', [PostController::class, 'unarchivePost'])->name('unarchivepost');
});
