<?php

namespace App\Modules\Report\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{

    // update report status
    public function updateStatus(Request $request, $id)
    {
        $item = $this->service->find($id);
        $item->status = $request->status;
        $item->save();
        return sendApiResponse([$this->resourceName => $this->transform($item)], ucfirst($this->resourceName) . ' updated successfully.');
    }
}
