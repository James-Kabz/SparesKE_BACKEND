<?php

use App\Modules\Orders\Controllers\OrderController;

Route::middleware(['auth:sanctum', ''])->group(function () {
    Route::apiResource('orders', OrderController::class);
});
