<?php

namespace App\Http\Controllers\client;
use App\Http\Controllers\Controller;
use App\Http\Requests\CharacteristicPostRequest;
use App\Http\Services\client\CharacteristicRequestService;
use App\Models\GeneralSettings;
use App\Repositories\client\SemesterOfStudyRepository;
use Illuminate\Support\Facades\Auth;

class CertificateСharacteristicController extends Controller
{
    public function characteristic()
    {
        return view('client.certificate.characteristic.characteristic', [
            'semester' => SemesterOfStudyRepository::activeList(),
            'description' => GeneralSettings::byTechName(GeneralSettings::CERT_CHARACTERISTIC_TECH)->content['data']['description_page'] ?? null
        ]);
    }

    public function store(CharacteristicPostRequest $request, CharacteristicRequestService $service)
    {
        $requestData = $request->validated();
        $result = $service->sendRequest($requestData, Auth::guard('student')->user()->id);

        $response = redirect()->route('certificate.characteristic');
        if ($result) {
            $response->with('success', 'Ваша заявка отправлена. Информацию по статусу заявки придет на электронную почту');
        } else {
            $response->with('fail', 'Произошла ошибка, попробуйте подождать и повторить еще раз');
        }

        return $response; 
    }
}
