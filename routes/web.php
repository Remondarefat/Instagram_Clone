<?php

use App\Models\CommentLike;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\MediaController;

use App\Http\Controllers\CommentController;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;



use App\Http\Controllers\PostSavedController;
use App\Http\Controllers\CommentLikeController;

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

// // post routes
// Route::get('/postprofile', function () {
//     return view('posts.profile');
// });

// Route::get('/posthome', function () {
//     return view('posts.home');
// });




require __DIR__ . '/auth.php';


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::post('/post', [PostController::class, 'store'])->name('posts.store');


// !-------------------------socilaite Routes--------------
Route::get('auth/{provider}/redirect',[SocialLoginController::class,'redirect'])
->name('auth.socilaite.redirect');
Route::get('auth/{provider}/callback',[SocialLoginController::class,'callback'])
->name('auth.socilaite.callback');


Route::post('/media', [MediaController::class, 'store'])->name('media');
Route::get('/user/{id}', [UserController::class, 'show'])->name('user');

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
Route::get('/search' , [UserController::class, 'search'])->name('search');

require __DIR__ . '/auth.php';

// !--------PostDesc Routes-------------------
Route::get('/postDesc', [PostController::class, 'index']);
Route::get('postDesc/{post}', [PostController::class, 'show'])->name('postDesc.show')->where('post', '[0-9]+');


// ! Like PostDesc
Route::post('/post/{postId}/toggle-like', [LikeController::class,'toggleLike'])->name('post.toggle-like');
// ! comment PostDesc
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
// ! Like comment postDesc
Route::post('/toggle-comment-like/{commentId}', [CommentLikeController::class, 'toggleCommentLike'])->name('toggleCommentLike');

// ! Saved posts
// Route::post('/save-post/{id}', [PostSavedController::class, 'save'])->name('save.post');
Route::post('posts/{id}/save', [PostSavedController::class, 'store'])->name('saved.posts.store');
Route::delete('/saved-posts/{id}', [PostSavedController::class, 'destroy'])->name('saved-posts.destroy');

