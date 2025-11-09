<?php

namespace App\Modules\Orders\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Add this import

class OrderController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $items = $this->service->all($this->with, $this->orderBy)->where('user_id', $user->id);
        return sendApiResponse([$this->resourceName => $this->transform($items)], ucfirst($this->resourceName) . ' fetched successfully.');
    }

    public function show($id)
    {
        /** @var User $user */
        $user = auth()->user();
        $item = $this->service->find($id, $this->with);

        if (!$item || $item->user_id !== $user->id) {
            return sendApiError('Not found', 404);
        }

        return sendApiResponse([$this->resourceName => $this->transform($item)], ucfirst($this->resourceName) . ' retrieved successfully.');
    }

    // get orders for vendors
    public function vendorIndex()
    {
        /** @var User $user */
        $user = auth()->user();
        $vendor = \App\Modules\Vendors\Models\Vendor::where('user_id', $user->id)->first();

        if (!$vendor) {
            return sendApiError('Vendor profile not found', 404);
        }

        $items = $this->service->all($this->with, $this->orderBy)->where('vendor_id', $vendor->id);
        return sendApiResponse([$this->resourceName => $this->transform($items)], ucfirst($this->resourceName) . ' fetched successfully.');
    }

    // update order status
    public function updateStatus(Request $request, $id)
    {
        $item = $this->service->find($id);
        $item->status = $request->status;
        $item->save();
        return sendApiResponse([$this->resourceName => $this->transform($item)], ucfirst($this->resourceName) . ' updated successfully.');
    }
}
