<?php

use App\Modules\Review\Controllers\ReviewController;

Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
    Route::apiResource('reviews', ReviewController::class)->except(['destroy']);
});

Route::middleware(['auth:sanctum', 'role:super-admin'])->group(function () {
    Route::delete('reviews/{id}', [ReviewController::class, 'destroy']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('vendor/{id}/reviews', [ReviewController::class, 'vendorIndex']);
});
