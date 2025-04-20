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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
