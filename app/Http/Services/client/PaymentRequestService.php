<?php

namespace App\Http\Services\client;

use App\Http\Services\Helper;
use App\Models\Request;
use App\Models\RequestPayment;
use Error;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentRequestService
{
    public function sendRequest(array $requestData, int $studentId)
    {
        try {
            DB::beginTransaction();
            $file = Helper::uploadFile(
                file: $requestData['formFile'],
                group: 'payment_order'
            );
            $entity = new RequestPayment();
            $entity->semester = $requestData['inputSemester'];
            $entity->save();
            $entity->attachment()->syncWithoutDetaching([$file->id]);
            $request = Request::fillPersonalData($requestData);
            $request->request_type = RequestPayment::class;
            $request->request_id = $entity->id;
            $request->student_id = $studentId;
            $request->save();
            DB::commit();
            return true;
        } catch (Error | Exception $exception) {
            DB::rollBack();
            dd($exception);
            return false;
        }
    }
}
