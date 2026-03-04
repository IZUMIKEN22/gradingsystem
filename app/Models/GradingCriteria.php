<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradingCriteria extends Model
{
    protected $table = 'grading_criterias';
    protected $fillable = ['class_id', 'component_name', 'percentage'];

    public function assessments() {
        return $this->hasMany(Assessment::class, 'grading_criteria_id');
    }

    public function class() {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
