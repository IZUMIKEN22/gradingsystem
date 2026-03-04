<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AcademicYear;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'class_id';

    protected $fillable = [
        'teacher_id',
        'academic_year_id',
        'semester',
        'department_id',
        'block_id',
        'section',
        'subject_code',
        'subject_description',
        'schedule_date',
        'schedule_time',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }
}