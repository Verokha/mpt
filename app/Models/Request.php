<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    const WAIT_ACTION = 'wait_action';
    const WAIT_SEND = 'wait_send';
    const ARCHIVE = 'archive';
    const STATUSES = [
        self::WAIT_ACTION => 'В ожидании действий',
        self::WAIT_SEND => 'В ожидании отправки',
        self::ARCHIVE => 'Сформировано',
    ];

    const ACTIONS = [
        self::WAIT_ACTION => [
            'reject' => 'Отклонить', 
            'accept' => 'Принять'
        ],
        self::WAIT_SEND => ['confirm' => 'Подтвердить'],
        self::ARCHIVE => [],
    ];

    const TYPES_TRANSLATE = [
        'payment' => 'Квитанция об оплате',
        'study' => 'Справка об обучении',
        'characteristic' => 'Характеристика о студенте',
    ];

    protected $fillable = [
        'first_name',
        'second_name',
        'patronymic',
        'group',
        'student_id',
    ];

    protected static function booted(): void
    {
        static::deleted(function (Request $request) {
            $request->requestTypeRelation->delete();
        });
    }

    public static function fillPersonalData(array $requestData) 
    {
        $request = new self();
        $request->first_name = $requestData['inputFirstdName'];
        $request->second_name = $requestData['inputSecondName'];
        $request->patronymic = $requestData['inputPatronymic'];
        $request->group = $requestData['inputGroup'];
        return $request;
    }

    public function requestTypeRelation()
    {
        return $this->hasOne($this->request_type, 'id', 'request_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function changeStatus(string $status)
    {
        $this->status = $status;
        return $this;
    }

    public static function getTypeStatement(string $model)
    {
        return self::TYPES_TRANSLATE[mb_strtolower(str_replace('App\Models\Request', '', $model))];
    }
}
