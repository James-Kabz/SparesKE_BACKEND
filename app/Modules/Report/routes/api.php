<?php

use App\Modules\Report\Controllers\ReportController;

Route::middleware(['auth:sanctum', ''])->group(function () {
    Route::apiResource('reports', ReportController::class);
});
