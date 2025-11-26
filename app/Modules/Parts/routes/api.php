<?php

use App\Modules\Parts\Controllers\PartController;

// Public routes
Route::get('parts', [PartController::class, 'index']);
Route::get('parts/{id}', [PartController::class, 'show']);

// Vendor-only routes
Route::middleware(['auth:sanctum', 'role:vendor'])->group(function () {
    Route::get('vendor/parts', [PartController::class, 'vendorParts']);
    Route::get('vendor/parts/{id}', [PartController::class, 'vendorPart']);
    Route::post('vendor/parts', [PartController::class, 'store']);
    Route::put('vendor/parts/{id}', [PartController::class, 'update']);
    Route::delete('vendor/parts/{id}', [PartController::class, 'destroy']);
});
