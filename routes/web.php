<?php
use App\Http\Controllers\ArchivePostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class,'index'])->name('index');
Route::get('/notification', [IndexController::class,'index'])->name('notification');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('credentials');
Route::post('/adduser', [RegisterController::class, 'adduser'])->name('adduser');

Route::post('/post-list', [PostController::class, 'show'])->name('allpost');
Route::post('/getcomments', [PostController::class, 'getcomments'])->name('getcomments');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::post('/addpost', [PostController::class, 'addpost'])->name('addpost');

    Route::get('/getpost', [PostController::class, 'show'])->name('getpost');

    Route::post('/profileupdate/{id}', [RegisterController::class, 'profileUpdate'])->name('profileupdate');

    // likepost
    Route::post('/likepost', [PostController::class, 'likepost'])->name('likepost');

    // commentpost
    Route::post('/commentpost', [PostController::class, 'commentpost'])->name('commentpost');

    //delete post
    Route::delete('/deletepost',[PostController::class, 'deletepost'])->name('deletepost');

    //follow 
    Route::post('/follow', [IndexController::class, 'follow'])->name('follow');
    Route::post('/unfollow', [IndexController::class, 'unfollow'])->name('unfollow');

    Route::get('/notification',[NotificationController::class,'show'])->name('notification');
    // Route::get('/notifications', [NotificationController::class, 'likenotify']);

    // archive post
    Route::get('/archivepost',[ArchivePostController::class,'show'])->name('archivepost');
    Route::post('/archivepost',[PostController::class,'archivepost'])->name('archivepost');
    Route::post('/unarchivepost',[PostController::class,'unarchivePost'])->name('unarchivepost');
});
