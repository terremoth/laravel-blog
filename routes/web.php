<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;

Auth::routes();

Route::get('/', [HomeController::class, 'index']);

Route::get('/post/{id}/{url?}', [PostController::class, 'show'])->name('post');
Route::get('/page/{id}/{url?}', [PageController::class, 'show'])->name('page');
Route::get('/tag/{name}', [TagController::class, 'show'])->name('tag');

Route::resource('page', PageController::class);


Route::get('/page', function () {
    return '<h1>Blog Pages</h1>';
});

Route::get('/user', function () {
    return '<h1>Users page</h1>';
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
