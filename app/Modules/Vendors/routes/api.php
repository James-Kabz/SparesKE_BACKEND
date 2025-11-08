<?php

use App\Modules\Vendors\Controller\VendorContoller;

Route::middleware(['auth:sanctum', ''])->group(function () {
    Route::apiResource('vendors', VendorContoller::class);
});
