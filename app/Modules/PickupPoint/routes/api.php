<?php

use App\Modules\PickupPoint\Controllers\PickupPointController;

Route::middleware(['auth:sanctum', ''])->group(function () {
    Route::apiResource('pickup-points', PickupPointController::class);
});
