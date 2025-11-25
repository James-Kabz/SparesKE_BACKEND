<?php

use App\Modules\Vendors\Controllers\VendorController;

Route::middleware(['auth:sanctum', 'role:vendor'])->group(function () {
    Route::apiResource('vendors', VendorController::class);
    Route::get('vendor/me', [VendorController::class, 'me']);
});

Route::middleware(['auth:sanctum', 'role:super-admin'])->group(function () {
    Route::put('vendors/{id}/verify', [VendorController::class, 'verifyVendor']);
});
