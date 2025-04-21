<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [\App\Http\Controllers\V1\Dashboard\DashboardController::class,'index'])->middleware('auth')->name('dashboard');
Route::resource('categories', \App\Http\Controllers\V1\Category\CategoryController::class)->middleware('auth');

Route::get('posts/search', [\App\Http\Controllers\V1\Post\PostController::class,'search'])->middleware('auth')->name('posts.search');
Route::resource('posts', \App\Http\Controllers\V1\Post\PostController::class)->middleware('auth');


require __DIR__.'/auth.php';
