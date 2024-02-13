<?php

use App\Http\Controllers\PayOrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get("/", [PostController::class, 'home']);
Route::get("posts/search", [PostController::class, "search"])->name('posts.search');
Route::resource("posts", PostController::class);
Route::resource("tags", TagController::class)->except(['show']);
Route::resource("users", UserController::class)->except(['show']);


Route::get('pay', [PayOrderController::class, 'index']);
