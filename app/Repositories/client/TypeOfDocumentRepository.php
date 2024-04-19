<?php

namespace App\Repositories\client;

use Illuminate\Support\Facades\DB;

class TypeOfDocumentRepository
{
    public static function activeList(): \Illuminate\Support\Collection
    {
        return DB::table('type_of_documents')
            ->select(['id', 'name'])
            ->where('is_active', '=', true)
            ->get();
    }

    public static function findById(int $id)
    {
        return DB::table('type_of_documents')
            ->select(['id', 'name'])
            ->where('id', '=', $id)
            ->get()
            ->first();
    }
}
