<?php

namespace App\Modules\Review\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // get vendor reviews
    public function vendorIndex($id)
    {
        $vendor = \App\Modules\Vendors\Models\Vendor::find($id);

        if (!$vendor) {
            return sendApiError('Vendor not found', 404);
        }

        $reviews = $vendor->reviews;

        return sendApiResponse($reviews, 'Vendor reviews retrieved successfully');
    }
}
