<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;

class RequestPayment extends Model
{
    use HasFactory, Attachable;

    protected $fillable = [
        'semester'
    ];
}
