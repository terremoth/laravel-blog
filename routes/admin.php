<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('posts', PostController::class);

    Route::get('/users', function () {
        return 'entrou!!';
    })->name('users');
});
