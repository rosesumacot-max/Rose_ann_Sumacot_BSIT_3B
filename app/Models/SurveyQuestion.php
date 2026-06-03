<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    protected $fillable = ['text', 'category', 'type', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}