<?php

namespace App\Http\Services\client;

use App\Models\Request;
use App\Models\RequestCharacteristic;
use App\Models\Student;
use Error;
use Exception;
use Illuminate\Support\Facades\DB;

class CharacteristicRequestService
{
    public function sendRequest(array $requestData, int $studentId)
    {
        try {
            DB::beginTransaction();
            $entity = new RequestCharacteristic();
            $entity->semester = $requestData['inputSemester'];
            $entity->birth_date = $requestData['inputYear'];
            $entity->school = $requestData['inputSchool'];
            $entity->end_school = $requestData['inputEndSchool'];
            $entity->start_mpt = $requestData['inputYearOfEntry'];
            $entity->responsibilities = $requestData['responsibilities'];
            $entity->whereNeeded = $requestData['inputWhereNeeded'];
            $entity->save();
            $request = Request::fillPersonalData($requestData);
            $request->request_type = RequestCharacteristic::class;
            $request->request_id = $entity->id;
            $request->student_id = $studentId;
            $request->save();
            DB::commit();
            return true;
        } catch (Error | Exception $exception) {
            DB::rollBack();
            return false;
        }
    }
}
