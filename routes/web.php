<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagAjaxController;
use App\Http\Controllers\PayOrderController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get("posts/search", [PostController::class, "search"])->name('posts.search');
Route::group(['middleware' => 'auth'], function () {
    Route::resource("posts", PostController::class);
    Route::resource("tags", TagController::class)->except(['show']);
    Route::resource("ajax-tags", TagAjaxController::class)->except(['show']);
    Route::resource("users", UserController::class)->except(['show']);
});


Auth::routes();
Route::get('pay', [PayOrderController::class, 'index']);
