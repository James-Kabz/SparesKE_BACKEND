<?php

namespace App\Modules\PickupPoint\Controllers;

use App\Modules\PickupPoint\Models\PickupPoint;
use App\Modules\Vendors\Models\Vendor;

class PickupPointController extends Controller
{
    // get vendor pickup points
    public function vendorPickupPoints()
    {
        $user = auth()->user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        if (!$vendor) {
            return sendApiError('Vendor not found', 404);
        }

        $pickupPoints = $vendor->pickupPoints;

        return sendApiResponse($pickupPoints, 'Vendor Pickup points retrieved successfully');
    }
}
