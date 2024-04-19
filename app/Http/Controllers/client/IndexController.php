<?php

namespace App\Http\Controllers\client;
use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Repositories\client\FaqRepository;

class IndexController extends Controller
{
    public function home()
    {
        return view('client.home', [
            'faqs' => FaqRepository::activeList(),
            'description' => GeneralSettings::byTechName(GeneralSettings::HOME_TECH)->content['data']['description_page'] ?? null
        ]);
    }
}
