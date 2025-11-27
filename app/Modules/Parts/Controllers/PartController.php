<?php

namespace App\Modules\Parts\Controllers;

use App\Modules\Parts\Models\Part;
use App\Modules\Vendors\Models\Vendor;
use Illuminate\Http\Request;

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
            ['part' => $this->transform( $parts)],
            'Vendor parts fetched successfully.'
        );
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
            'Vendor part fetched successfully.'
        );
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $this->uploadFile($request, 'image', 'parts/images');
            if ($path) {
                $data['images'] = [$path];
            }
        }

        // Use merge to combine data
        $mergedRequest = new Request($data);
        return parent::store($mergedRequest);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $this->uploadFile($request, 'image', 'parts/images');
            if ($path) {
                // Get existing images and append new one
                $part = $this->service->find($id);
                $existingImages = is_array($part->images) ? $part->images : [];
                $existingImages[] = $path;
                $data['images'] = $existingImages;
            }
        }

        $mergedRequest = new Request($data);
        return parent::update($mergedRequest, $id);
    }
}
