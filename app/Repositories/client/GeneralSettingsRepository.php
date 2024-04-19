<?php

namespace App\Repositories\client;

use Illuminate\Support\Facades\DB;

class GeneralSettingsRepository
{
    public static function byTechName(string $techName)
    {
        return DB::table('general_settings', 'gs')
            ->where('gs.tech_name', '=', $techName)
            ->get()
            ->first();
    }
}
