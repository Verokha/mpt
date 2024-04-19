<?php

namespace App\Http\Controllers\client;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentPostRequest;
use App\Http\Services\client\PaymentRequestService;
use App\Models\GeneralSettings;
use App\Repositories\client\SemesterOfStudyRepository;
use Illuminate\Support\Facades\Auth;

class CertificatePaymentOrderController extends Controller
{
    public function paymentOrder()
    {
        return view('client.certificate.paymentOrder.paymentOrder', [
            'semester' => SemesterOfStudyRepository::activeList(),
            'description' => GeneralSettings::byTechName(GeneralSettings::CERT_PO_TECH)->content['data']['description_page'] ?? null
        ]);
    }

    public function store(PaymentPostRequest $request, PaymentRequestService $service)
    {
        $requestData = $request->validated();
        $result = $service->sendRequest($requestData, Auth::guard('student')->user()->id);

        $response = redirect()->route('certificate.paymentOrder');
        if ($result) {
            $response->with('success', 'Ваша заявка отправлена. Информацию по статусу заявки придет на электронную почту');
        } else {
            $response->with('fail', 'Произошла ошибка, попробуйте подождать и повторить еще раз');
        }

        return $response; 
                         
    }
}
