<?php

use App\Modules\Orders\Controllers\OrderController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('orders', OrderController::class);
});

Route::middleware(['auth:sanctum', 'role:vendor'])->group(function () {
    Route::get('vendor/orders', [OrderController::class, 'vendorIndex']);
});
