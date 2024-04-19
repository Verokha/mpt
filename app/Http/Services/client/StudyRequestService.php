<?php

namespace App\Http\Services\client;

use App\Models\Request;
use App\Models\RequestStudy;
use App\Repositories\client\TypeOfDocumentRepository;
use Error;
use Exception;
use Illuminate\Support\Facades\DB;

class StudyRequestService
{
    public function sendRequest(array $requestData, int $studentId)
    {
        try {
            DB::beginTransaction();
            $entity = new RequestStudy();
            $entity->type_document = TypeOfDocumentRepository::findById($requestData['typeDoc'])->name;
            $entity->save();
            $request = Request::fillPersonalData($requestData);
            $request->request_type = RequestStudy::class;
            $request->request_id = $entity->id;
            $request->student_id = $studentId;
            $request->save();
            DB::commit();
            return true;
        } catch (Error | Exception $excteption) {
            DB::rollBack();
            return false;
        }

    }
}
