<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::prefix('admin')->middleware('auth')->name('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/users', function () {
        return 'entrou!!';
    });
});

