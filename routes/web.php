<?php

use App\Models\CommentLike;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HashtagController;


use App\Http\Controllers\CommentController;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;



use App\Http\Controllers\PostSavedController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\Auth\SocialLoginController;






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
    return view('auth.login');
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


// -----------------------------------------------------------------------------------

Route::post('/media', [MediaController::class, 'store'])->name('media');
Route::get('/user/{id}', [UserController::class, 'show'])->name('user');

    // Route::get('/postprofile',[PostController::class,'index']);

    Route::get('/posthome', [PostController::class, 'index']);

    Route::get('/like-post', [PostController::class, 'like'])->name('like.post');
});

//Routes for follow
Route::post('/user/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow');
Route::post('/user/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow');
//Routes for block
Route::post('/user/{user}/block', [BlockController::class, 'block'])->name('users.block');
Route::post('/user/{user}/unblock', [BlockController::class, 'unblock'])->name('users.unblock');

// Route::get('/postprofile',[PostController::class,'index']);

Route::get('/posthome', [PostController::class, 'index']);

Route::get('/like-post', [PostController::class, 'like'])->name('like.post');
Route::get('/comment-post', [PostController::class, 'comment'])->name('comment.post');
Route::get('/comment-like', [CommentLikeController::class, 'commentlike'])->name('comment.like');

// Route::get('/posts/byHashtag/{hashtag}', 'PostController@getPostsByHashtag')->name('posts.byHashtag');
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/hashtag/{hashtagName}', [PostController::class, 'hash']);

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
Route::post('posts/{id}/save', [PostSavedController::class, 'store'])->name('saved.posts.store');
Route::delete('/saved-posts/{id}', [PostSavedController::class, 'destroy'])->name('saved-posts.destroy');
Route::get('/saved-posts', [PostSavedController::class, 'index'])->name('saved.posts.index');

