<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
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

// post routes
Route::get('/postprofile', function () {
    return view('posts.profile');
});

Route::get('/posthome', function () {
    return view('posts.home');
});



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

Route::get('/koko', [UserController::class, 'index']);



// !--------PostDesc Routes-------------------
Route::get('/postDesc', [PostController::class, 'index']);
Route::get('postDesc/{post}', [PostController::class, 'show'])->name('postDesc.show')->where('post', '[0-9]+');

});
require __DIR__ . '/auth.php';
