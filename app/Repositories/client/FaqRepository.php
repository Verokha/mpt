<?php

namespace App\Repositories\client;

use Illuminate\Support\Facades\DB;

class FaqRepository
{
    public static function activeList(): \Illuminate\Support\Collection
    {
        return DB::table('faqs')
            ->select(['question', 'answer'])
            ->where('is_active', '=', true)
            ->get();
    }
}
