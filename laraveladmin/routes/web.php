<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\TagController;

Route::get('/', [PostController::class,'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class,'show'])->name('posts.show');
Route::get('category/{category}', [PostController::class,'category'])->name('posts.category');
Route::get('tag/{tag}', [PostController::class,'tag'])->name('posts.tag');
Auth::routes();
Route::resource('categories', CategoryController::class)->names('admin.categories');
Route::resource('tags', TagController::class)->names('admin.tags');
Route::resource('postss', AdminPostController::class)->names('admin.posts');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/admin', function () {
//     return view('admin');
// });
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
