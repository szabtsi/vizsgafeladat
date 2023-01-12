<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyPostsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('home');

Route::middleware('guest')->group(function() {
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');

    Route::get('/login', [UserController::class, 'login_show'])->name('login.show');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function() {
    Route::post('/logout', [UserController::class, 'destroy'])->name('user.logout');

    Route::controller(PostController::class)->group(function() {
        Route::get('/post', 'create')->name('post.create');
        Route::get('/post/{id}', 'show')->name('myposts');
        Route::get('/myposts/{id}', 'edit')->name('myposts.edit');
        Route::post('/post', 'store')->name('post.store');
        Route::post('/myposts/{id}', 'update')->name('myposts.update');
        Route::delete('/myposts/{id}', 'destroy')->name('myposts.destroy');
    });
});
