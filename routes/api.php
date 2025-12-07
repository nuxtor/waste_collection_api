<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DriverJobController;
use App\Http\Controllers\Api\PhotoUploadController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/driver/jobs', [DriverJobController::class, 'index']);
    Route::get('/driver/jobs/{job}', [DriverJobController::class, 'show']);
    Route::post('/driver/jobs/{job}/complete', [DriverJobController::class, 'complete']);

    Route::post('/driver/photos', [PhotoUploadController::class, 'store']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});
