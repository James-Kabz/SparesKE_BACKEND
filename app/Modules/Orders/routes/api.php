<?php

use App\Modules\Orders\Controllers\OrdersController;

Route::middleware(['auth:sanctum', ''])->group(function () {
    Route::apiResource('orders', OrdersController::class);
});
