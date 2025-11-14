<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
Route::get('/', function () {
return view('welcome');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Quản lý danh mục chủ đề
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/detail/{id}', [CategoryController::class, 'show'])->name('category.detail');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/create', [CategoryController::class, 'store'])->name('category.create');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/edit/{id}', [CategoryController::class, 'update'])->name('category.edit');
Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
// Quản lý các bản tin
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/detail/{id}', [NewsController::class, 'show'])->name('news.detail');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('/news/create', [NewsController::class, 'store'])->name('news.create');
Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
Route::post('/news/edit/{id}', [NewsController::class, 'update'])->name('news.edit');
Route::get('/news/delete/{id}', [NewsController::class, 'destroy'])->name('news.delete');
//Route::get('/', function () {
// return view('welcome');
//});
// Trang xem tin mặc định
Route::get('/', [NewsController::class, 'main'])->name('main');