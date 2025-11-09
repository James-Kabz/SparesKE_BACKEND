<?php

use App\Modules\Parts\Controllers\PartController;

// Public routes
Route::get('parts', [PartController::class, 'index']);
Route::get('parts/{id}', [PartController::class, 'show']);

// Vendor-only routes
Route::middleware(['auth:sanctum', 'role:vendor'])->group(function () {
    Route::post('parts', [PartController::class, 'store']);
    Route::put('parts/{id}', [PartController::class, 'update']);
    Route::delete('parts/{id}', [PartController::class, 'destroy']);
});
