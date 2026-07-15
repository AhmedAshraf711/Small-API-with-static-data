<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('throttle:register_login')->group(function () {
   Route::post('register',[UserController::class,'register']);
   Route::post('login',[UserController::class,'login']);
});

Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');
Route::middleware(['auth:sanctum','throttle:api'])->group(function () {
Route::apiResource('posts', PostController::class);
});

