<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'class_id',
        'grading_criteria_id',
        'title',
        'highest_score',
        'type',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // ✅ SINGULAR kasi belongsTo
    public function gradingCriteria()
    {
        return $this->belongsTo(GradingCriteria::class, 'grading_criteria_id');
    }
}
