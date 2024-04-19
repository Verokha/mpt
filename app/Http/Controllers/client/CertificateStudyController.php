<?php

namespace App\Http\Controllers\client;
use App\Http\Controllers\Controller;
use App\Http\Requests\CertificateStudyPostRequest;
use App\Http\Services\client\StudyRequestService;
use App\Models\GeneralSettings;
use App\Repositories\client\TypeOfDocumentRepository;
use Illuminate\Support\Facades\Auth;

class CertificateStudyController extends Controller
{
    public function study()
    {
        return view('client.certificate.study.study', [
            'typeOfDocs' => TypeOfDocumentRepository::activeList(),
            'description' => GeneralSettings::byTechName(GeneralSettings::CERT_STUDY_TECH)->content['data']['description_page'] ?? null
        ]);
    }

    public function store(CertificateStudyPostRequest $request, StudyRequestService $service)
    {
        $requestData = $request->validated();
        $result = $service->sendRequest($requestData, Auth::guard('student')->user()->id);

        $response = redirect()->route('certificate.study');
        if ($result) {
            $response->with('success', 'Ваша заявка отправлена. Информацию по статусу заявки придет на электронную почту');
        } else {
            $response->with('fail', 'Произошла ошибка, попробуйте подождать и повторить еще раз');
        }

        return $response; 
                         
    }
}
