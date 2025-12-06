<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DriverJobController;
use App\Http\Controllers\Api\PhotoUploadController;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);

Route::middleware('auth:sanctum')->group(function () {
    // Driver-specific
    Route::get('/driver/jobs', [DriverJobController::class, 'index']);
    Route::get('/driver/jobs/{job}', [DriverJobController::class, 'show']);
    Route::post('/driver/jobs/{job}/complete', [DriverJobController::class, 'complete']);

    Route::post('/driver/photos', [PhotoUploadController::class, 'store']);
});