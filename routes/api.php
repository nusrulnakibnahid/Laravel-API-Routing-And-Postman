<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController as PostController;
use App\Http\Controllers\API\V1\PostController as PostControllerV1;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/posts', PostController::class);


Route::prefix('v1')->group(function () {
    Route::apiResource('/posts', PostControllerV1::class);
});


// Not Implemented
Route::prefix('v2')->group(function () {
    Route::apiResource('/posts', PostController::class);
});