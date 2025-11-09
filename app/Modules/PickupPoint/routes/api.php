<?php

use App\Modules\PickupPoint\Controllers\PickupPointController;

Route::middleware(['auth:sanctum', 'role:vendor'])->group(function () {
    Route::get('vendor/pickup-points', [PickupPointController::class, 'vendorPickupPoints']);
    Route::apiResource('pickup-points', PickupPointController::class);
});
