<?php

namespace App\Http\Controllers\panel;

use App\Http\Services\panel\RequestPanelService;

class PanelRequestController
{
    public function index(RequestPanelService $service)
    {
        $statusRequest = request()->get('status_request', 'all');
        $typeRequest = request()->get('type_request', 'study');
        $responseData = $service->listRequests(
            $statusRequest,
            $typeRequest
        );

        return view('panel.index', [
            'data' => $responseData,
            'statusRequest' => $statusRequest,
            'typeRequest' => $typeRequest,
        ]);
    }
}
