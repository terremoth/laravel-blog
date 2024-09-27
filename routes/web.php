<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);


Route::get('/post/{id}/{url?}', [\App\Http\Controllers\PostController::class, 'show'])->name('post');

Route::resource('post', \App\Http\Controllers\PostController::class);

Route::get('/admin', function () {
    return '<h1>Admin Page</h1>';
});

Auth::routes();

Route::get('/page', function () {
    return '<h1>Blog Pages</h1>';
});

Route::get('/user', function () {
    return '<h1>Users page</h1>';
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
