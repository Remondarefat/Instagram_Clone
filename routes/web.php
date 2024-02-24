<?php

use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/post', [PostController::class, 'store'])->name('posts.store');

    Route::post('/media', [MediaController::class, 'store'])->name('media');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user');

    Route::get('/koko', [UserController::class, 'index']);
});

//Testing for follow
Route::post('/user/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow');
Route::post('/user/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow');

// Route::get('/postprofile',[PostController::class,'index']);

Route::get('/posthome', [PostController::class, 'index']);

Route::get('/like-post', [PostController::class, 'like'])->name('like.post');
require __DIR__ . '/auth.php';
