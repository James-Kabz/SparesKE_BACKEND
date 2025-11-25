<?php

namespace App\Modules\Vendors\Controllers;

use App\Modules\Vendors\Models\Vendor;
use Illuminate\Database\QueryException;

class VendorController extends Controller
{
    // get current authenticated user's vendor profile
    public function me()
    {
        try {
            $user = auth()->user();
            $vendor = Vendor::where('user_id', $user->id)->first();

            if (!$vendor) {
                // Create vendor profile if it doesn't exist
                $vendor = Vendor::create([
                    'user_id' => $user->id,
                    'shop_name' => $user->name . "'s Shop",
                    'description' => null,
                    'location' => $user->location ?? null,
                    'phone' => $user->phone ?? null,
                    'verified' => false,
                    'rating' => 0,
                    'socials' => null,
                ]);
            }

            return sendApiResponse(
                ['vendor' => $this->transform($vendor)],
                'Vendor profile retrieved successfully',
                200
            );
        } catch (QueryException $e) {
            return sendApiError('Failed to retrieve vendor profile', 500, $e->getMessage());
        } catch (\Exception $e) {
            return sendApiError('An unexpected error occurred', 500, $e->getMessage());
        }
    }

    // verify vendor profile
    public function verifyVendor(int $id)
    {
        try {
            $vendor = Vendor::find($id);

            if (!$vendor) {
                return sendApiError(['message' => 'Vendor not found'], 404);
            }

            if ($vendor->verified) {
                return sendApiError(['message' => 'Vendor is already verified'], 400);
            }

            $vendor->update([
                'verified' => 1,
            ]);

            return sendApiResponse(
                ['vendor' => $this->transform($vendor)],
                'Vendor verified successfully',
                200
            );
        } catch (QueryException $e) {
            return sendApiError('Failed to verify vendor', 500, $e->getMessage());
        } catch (\Exception $e) {
            return sendApiError('An unexpected error occurred', 500, $e->getMessage());
        }
    }
}
