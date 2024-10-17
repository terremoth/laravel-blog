<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('posts', PostController::class);
    Route::resource('tags', TagController::class);
    Route::resource('pages', PageController::class);

    Route::get('posts/delete-featured-/{post}/{token}', [PostController::class, 'deleteFeaturedImage'])
        ->name('posts.delete-featured-image');
    Route::get('pages/delete-featured-image/{page}/{token}', [PageController::class, 'deleteFeaturedImage'])
        ->name('pages.delete-featured-image');
});
