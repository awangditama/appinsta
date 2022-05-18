<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\DashboardController;


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

Route::get('/', function () {
    return view('index');
});
Route::get("/register", [UserController::class, 'register'])->name('user.register');
Route::get("/login", [UserController::class, 'login'])->name('user.login');
Route::post("/register", [UserController::class, 'store'])->name('user.register');
Route::post("/login", [UserController::class, 'auth'])->name('user.login.auth');

Route::get("/dashboard", [DashboardController::class, 'index'])->name('user.dashboard')->middleware('auth');
Route::get("/post", [PostController::class, 'index'])->name('user.view-post')->middleware('auth');
Route::get("/post/create", [PostController::class, 'create'])->name('user.create-post')->middleware('auth');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth');
Route::post('/post/create', [PostController::class, 'store'])->name('user.create.post')->middleware('auth');
Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('user.edit.post')->middleware('auth');
Route::put('/post/update/{id}', [PostController::class, 'update'])->name('user.update.post')->middleware('auth');
Route::delete('/post/delete/{id}', [PostController::class, 'delete'])->name('user.delete.post')->middleware('auth');
Route::get('/commentar/{id}', [DashboardController::class, 'commentar'])->name('user.commentar')->middleware('auth');
Route::post('/commentar/create/{id}', [DashboardController::class, 'create_commentar'])->name('user.create-commentar')->middleware('auth');
Route::post('/dashboard/{id}', [DashboardController::class, 'like'])->name('user.like')->middleware('auth');
Route::post('/dashboard/unlike/{id}', [DashboardController::class, 'unlike'])->name('user.unlike')->middleware('auth');
