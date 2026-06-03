<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'location',
        'average_rating',
        'total_reviews',
    ];

    public function responses()
    {
        return $this->hasMany(SurveyResponse::class);
    }
}