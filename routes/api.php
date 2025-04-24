<?php

use App\Http\Controllers\Colors\ColorsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Public Routes
Route::prefix('v1')->group(function () {
    Route::prefix('colors')->group(function () {
        Route::get('/', [ColorsController::class, 'index']);
        Route::get('/{id}', [ColorsController::class, 'show']);
    });
});

// Protected Routes
Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::prefix('colors')->group(function () {
        Route::post('/', [ColorsController::class, 'store']);
        Route::put('/{id}', [ColorsController::class, 'update']);
        Route::delete('/{id}', [ColorsController::class, 'destroy']);
    });
});