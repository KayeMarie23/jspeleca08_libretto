<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AuthorController as ApiAuthorController;
use App\Http\Controllers\API\BookController as ApiBookController;
use App\Http\Controllers\API\GenreController as ApiGenreController;
use App\Http\Controllers\API\ReviewController as ApiReviewController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('authors', ApiAuthorController::class);
    Route::apiResource('books', ApiBookController::class);
    Route::apiResource('genres', ApiGenreController::class);
    Route::apiResource('reviews', ApiReviewController::class);
});
