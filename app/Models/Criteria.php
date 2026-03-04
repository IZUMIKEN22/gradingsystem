<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = 'grading_criterias'; // <-- Ito ang table name mo

    protected $fillable = [
        'class_id',
        'component_name',
        'percentage',
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'grading_criteria_id');
    }
}