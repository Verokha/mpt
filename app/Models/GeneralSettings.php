<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    use HasFactory;

    const HOME_TECH = 'home_page';
    const CERT_STUDY_TECH = 'cert_study_page';
    const CERT_CHARACTERISTIC_TECH = 'cert_characteristic_page';
    const CERT_PO_TECH = 'certificate_p_o_page';

    protected $casts = [
        'content' => 'array',
    ];

    public static function byTechName(string $techName): ?GeneralSettings
    {
        return GeneralSettings::where('tech_name', '=', $techName)->get()->first();
    }
}
