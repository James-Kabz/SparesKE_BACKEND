<?php

use App\Modules\Vendors\Controllers\VendorController;

Route::middleware(['auth:sanctum', ''])->group(function () {
    Route::apiResource('vendors', VendorController::class);
});
