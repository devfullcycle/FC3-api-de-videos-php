<?php

use App\Http\Controllers\Api\{
    CastMemberApiController,
    CategoryApiController,
    GenreApiController
};
use Illuminate\Support\Facades\Route;

Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/categories/{category}', [CategoryApiController::class, 'show']);

Route::get('/genres', [GenreApiController::class, 'index']);
Route::get('/genres/{genre}', [GenreApiController::class, 'show']);

Route::get('/cast_members', [CastMemberApiController::class, 'index']);
Route::get('/cast_members/{genre}', [CastMemberApiController::class, 'show']);

Route::get('/', fn () => response()->json(['message' => 'success']));
