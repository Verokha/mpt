<?php

namespace App\Repositories\client;

use Illuminate\Support\Facades\DB;

class SemesterOfStudyRepository
{
    public static function activeList()
    {
        return DB::table('semester_of_studies')
            ->select(['id', 'name'])
            ->where('is_active', '=', true)
            ->get();
    }
}
