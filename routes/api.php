<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/posts', [PostController::class,'index'])->name('posts.index');
// Route::get('/posts/{post}', [PostController::class,'show'])->name('posts.show');

Route::apiResource('posts', PostController::class);


