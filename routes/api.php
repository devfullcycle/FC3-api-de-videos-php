<?php

use App\Http\Controllers\Api\{
    CategoryApiController
};
use Illuminate\Support\Facades\Route;

Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/categories/{category}', [CategoryApiController::class, 'show']);

Route::get('/', fn () => response()->json(['message' => 'success']));
