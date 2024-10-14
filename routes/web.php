<?php

use App\Http\Controllers\CommentController;
use App\Models\Tag;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;

Auth::routes();

Route::get('/', [HomeController::class, 'index']);

Route::get('/post/{post}/{url?}', [PostController::class, 'show'])->name('post');
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

Route::get('/tag-list', static function (Tag $tag) {
    return response()->json($tag::select('name')->distinct()->get()->pluck('name'));
});

Route::post('/comment/{post}', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');

Route::get('/refresh-captcha', static function() {
    return back()->withFragment('#comment-area');
})->name('captcha.refresh');

Route::get('/captcha-audio/{token}', static function (Illuminate\Http\Request $request, $token = null) {

    if ($request->session()->token() != $token) {
        abort(401);
    }

    $phrase = strtoupper(session('captcha_phrase', ''));
    $phrase = str_split($phrase);
    $phrase = implode('. ', $phrase);
    $audio = \Ibroid\PhpTts\Tts::generateAudio($phrase, ["lang" => config('app.locale'), "timeout" => 5000]);
    return response(base64_decode($audio))->header('Content-Type', 'audio/x-wav');
})->name('captcha-audio');
