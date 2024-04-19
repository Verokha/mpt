<?php

namespace App\Repositories\panel;

use App\Models\Request;
use App\Models\RequestCharacteristic;
use App\Models\RequestPayment;
use App\Models\RequestStudy;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class RequestRepository
{
    private static function paymentSubQuery(Builder &$query, string $class, string $table)
    {
        $query->selectRaw("
                    $table.semester,
                    (
                        SELECT CONCAT(a.`path`,a.name,'.',a.extension)  as a_id from attachments a 
                        join attachmentable a2 on a2.attachment_id = a.id 
                        where a2.attachmentable_type = ? and a2.attachmentable_id = $table.id 
                    ) as file", [$class]);
    }

    private static function studySubQuery(Builder &$query, string $table)
    {
        $query->addSelect(["$table.type_document as typeDocument"]);
    }

    private static function characteristicSubQuery(Builder &$query, string $table)
    {
        $query->addSelect([
            "$table.semester",
            "$table.birth_date as birthDate",
            "$table.school",
            "$table.end_school as endSchool",
            "$table.start_mpt as startMpt",
            "$table.responsibilities",
            "$table.whereNeeded",
        ]);
    }
    public static function list(string $status, string $type)
    {
        $query = DB::table('requests', 'r');
        switch($type) {
            default:
            case 'payment':
                $class = RequestPayment::class;
                $table = (new $class)->getTable();
                self::paymentSubQuery($query, $class, $table);
                break;
            case 'study':
                $class = RequestStudy::class;
                $table = (new $class)->getTable();
                self::studySubQuery($query, $table);
                break;
            case 'characteristic':
                $class = RequestCharacteristic::class;
                $table = (new $class)->getTable();
                self::characteristicSubQuery($query, $table);
                break;
        }
        if (array_key_exists($status, Request::STATUSES)) {
            $query->where('r.status', '=', $status);
        }
        return $query
            ->addSelect([
                'r.first_name',
                'r.second_name',
                'r.patronymic',
                'r.group',
                'r.status',
                'r.created_at',
                's.email'
            ])
            ->join($table, function(JoinClause $join) use ($class, $table) {
                $join->on('r.request_id', '=', $table.'.id')
                    ->where('r.request_type', '=', $class);
            })
            ->join('students as s', 's.id', '=', 'r.student_id')
            ->paginate(10);
    }
}
