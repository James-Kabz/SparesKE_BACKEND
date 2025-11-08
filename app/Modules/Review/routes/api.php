<?php

use App\Modules\Review\Controllers\ReviewController;

Route::middleware(['auth:sanctum', ''])->group(function () {
    Route::apiResource('reviews', ReviewController::class);
});
