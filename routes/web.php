<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ChatController;
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


Route::get('/home', function () {
    return view('home');
});
Route::get('/create-post', function () {
    return view('Create_post');
});
Route::get('/update-post', function () {
    return view('Update_post');
});

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
=======

// Route::get('/', function () {
//     return view('welcome');
Route::get('/chat', function () {
    return view('chat'); // Trả về view 'chat.blade.php'
    });
  
