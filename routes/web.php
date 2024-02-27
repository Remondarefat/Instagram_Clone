<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentLikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MediaController;

use App\Models\CommentLike;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/postprofile', [UserController::class,'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/post', [PostController::class, 'store'])->name('posts.store');
    Route::post('/media', [MediaController::class, 'store'])->name('media');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user');
    Route::get('/koko', [UserController::class, 'index']);


    // Route::post('/user/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow');
    // Route::post('/user/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow');

    // Route::get('/postprofile',[PostController::class,'index']);

    Route::get('/posthome', [PostController::class, 'index']);

    Route::get('/like-post', [PostController::class, 'like'])->name('like.post');
});

//Testing for follow
Route::post('/user/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow');
Route::post('/user/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow');
//Testing for block
Route::post('/user/{user}/block', [BlockController::class, 'block'])->name('users.block');
Route::post('/user/{user}/unblock', [BlockController::class, 'unblock'])->name('users.unblock');

// Route::get('/postprofile',[PostController::class,'index']);

Route::get('/posthome', [PostController::class, 'index']);

Route::get('/like-post', [PostController::class, 'like'])->name('like.post');
Route::get('/comment-post', [PostController::class, 'comment'])->name('comment.post');
Route::get('/comment-like', [CommentLikeController::class, 'commentlike'])->name('comment.like');


require __DIR__ . '/auth.php';
