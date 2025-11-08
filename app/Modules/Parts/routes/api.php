<?php

use App\Modules\Parts\Controllers\PartController;

Route::middleware(['auth:sanctum', ''])->group(function () {
    Route::apiResource('parts', PartController::class);
});
