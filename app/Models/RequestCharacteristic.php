<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestCharacteristic extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester',
        'birth_date',
        'school',
        'end_school',
        'start_mpt',
        'responsibilities',
        'whereNeeded'
    ];
}
