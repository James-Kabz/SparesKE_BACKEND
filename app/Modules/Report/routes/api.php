<?php

use App\Modules\Report\Controllers\ReportController;

Route::middleware(['auth:sanctum', ''])->group(function () {
    Route::apiResource('reports', ReportController::class);
});

Route::middleware(['auth:sanctum', 'role:super-admin'])->group(function () {
    Route::delete('reports/{id}', [ReportController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'role:vendor'])->group(function () {
    Route::put('reports/{id}/status', [ReportController::class, 'updateStatus']);
});
