<?php

namespace App\Modules\Vendors\Controllers;

use App\Modules\Vendors\Models\Vendor;
use Illuminate\Database\QueryException;

class VendorController extends Controller
{
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
                'verified' => 1 ,
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
