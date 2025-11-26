<?php

namespace App\Modules\Parts\Controllers;

use App\Modules\Vendors\Models\Vendor;

class PartController extends Controller
{
    // fetch parts belonging to a vendor
    public function vendorParts()
    {
        $user = auth()->user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        if (!$vendor) {
            return sendApiError('Vendor not found', 404);
        }

        $parts = $vendor->parts;

        return sendApiResponse(
            ['part' => $parts],
            'Vendor parts fetched successfully.');
    }

    // fetch part belonging to a vendor
    public function vendorPart($id)
    {
        $user = auth()->user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        if (!$vendor) {
            return sendApiError('Vendor not found', 404);
        }

        $part = $vendor->parts()->find($id);

        if (!$part) {
            return sendApiError('Part not found', 404);
        }

        return sendApiResponse(
            ['part' => $part],
            'Vendor part fetched successfully.');
    }
}
