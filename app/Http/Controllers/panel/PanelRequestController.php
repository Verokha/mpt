<?php

namespace App\Http\Controllers\panel;

use App\Http\Services\panel\RequestPanelService;
use App\Mail\StudentMail;
use App\Models\Request;
use Error;
use Exception;
use Illuminate\Support\Facades\Mail;

class PanelRequestController
{
    public function index(RequestPanelService $service)
    {
        $statusRequest = request()->get('status_request', 'all');
        $typeRequest = request()->get('type_request', 'study');
        $search = request()->get('search', null);
        $responseData = $service->listRequests(
            $statusRequest,
            $typeRequest,
            $search
        );

        return view('panel.index', [
            'data' => $responseData,
            'statusRequest' => $statusRequest,
            'typeRequest' => $typeRequest,
            'search' => $search,
        ]);
    }

    public function rejectRequest(Request $request, RequestPanelService $service)
    {
        try {
            $message = $service->reject($request, request()->get('cause'));
            Mail::to($request->student->email)->send(new StudentMail([
                'content' => $message
            ]));
        } catch (Error | Exception $exception) {
            return response()->json([
                'title' => 'Произошла ошибка',
                'message' => 'Произошла ошибка на сервере, попробуйте позже'
            ]);
        }

        return response()->json([
            'title' => 'Уведомление отправлено',
            'message' => 'Уведомление отправлено студенту на электронную почту.'
        ]);
    }

    public function acceptRequest(Request $request, RequestPanelService $service)
    {
        try {
            $message = $service->accept($request);
            Mail::to($request->student->email)->send(new StudentMail([
                'content' => $message
            ]));
        } catch (Error | Exception $exception) {
            return response()->json([
                'title' => 'Произошла ошибка',
                'message' => 'Произошла ошибка на сервере, попробуйте позже'
            ]);
        }

        return response()->json([
            'title' => 'Уведомление отправлено',
            'message' => 'Уведомление отправлено студенту на электронную почту.'
        ]);
    }

    public function confirmRequest(Request $request, RequestPanelService $service)
    {
        try {
            $message = $service->confirm($request);
            Mail::to($request->student->email)->send(new StudentMail([
                'content' => $message
            ]));
        } catch (Error | Exception $exception) {
            return response()->json([
                'title' => 'Произошла ошибка',
                'message' => 'Произошла ошибка на сервере, попробуйте позже'
            ]);
        }

        return response()->json([
            'title' => 'Уведомление отправлено',
            'message' => 'Уведомление отправлено студенту на электронную почту.'
        ]);
    }
}
