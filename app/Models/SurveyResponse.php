<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    protected $fillable = [
        'tourist_name',
        'tourist_email',
        'nationality',
        'age_group',
        'destination_id',
        'answers',
        'feedback_text',
        'overall_rating',
        'encoded_by',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}