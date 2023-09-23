<?php

use App\Http\Controllers\Api\{
    CastMemberApiController,
    CategoryApiController,
    GenreApiController,
    VideoApiController
};
use Illuminate\Support\Facades\Route;

Route::get('/videos', [VideoApiController::class, 'index']);
Route::get('/videos/{video}', [VideoApiController::class, 'show']);


Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/categories/{category}', [CategoryApiController::class, 'show']);

Route::get('/genres', [GenreApiController::class, 'index']);
Route::get('/genres/{genre}', [GenreApiController::class, 'show']);

Route::get('/cast_members', [CastMemberApiController::class, 'index']);
Route::get('/cast_members/{genre}', [CastMemberApiController::class, 'show']);

Route::get('/', fn () => response()->json(['message' => 'success']));
