<?php

use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('form_login');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/verify', [AuthController::class, 'showVerifyForm'])->name('form_verify');
Route::post('/verify', [AuthController::class, 'verify'])->name('verify');

Route::get('login/google', [AuthController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('login/github', [AuthController::class, 'redirectToGitHub']);
Route::get('login/github/callback', [AuthController::class, 'handleGitHubCallback']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('check_user');

Route::group(['prefix' => 'posts', 'middleware' => 'check_user', 'as' => 'posts.'], function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/create', function () {
        return view('create_post');
    })->name('create');

    Route::post('/create', [PostController::class, 'store'])->name('store');

    Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [PostController::class, 'update'])->name('update');
});


