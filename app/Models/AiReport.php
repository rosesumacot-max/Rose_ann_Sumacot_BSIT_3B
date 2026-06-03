<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiReport extends Model
{
    protected $fillable = [
        'report',
    ];

    protected $casts = [
        'report' => 'array',
    ];
}