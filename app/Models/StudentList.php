<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentList extends Model
{
    protected $table = 'student_list';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'class_id',
        'reg_number',
        'student_number',
        'student_name',
        'barangay',
        'city',
        'province',
        'date_of_birth',
        'sex',
        'mobile_number',
        'email',
    ];

    // Relationship to class
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'class_id');
    }

    // Relationship to scores
    public function scores()
    {
        return $this->hasMany(Score::class, 'student_id', 'id');
    }
    
    // Get all subjects for this student in the same block
    public function getOtherSubjectsInSameBlock()
    {
        if (!$this->class) {
            return collect();
        }
        
        return self::where('student_number', $this->student_number)
            ->whereHas('class', function($q) {
                $q->where('block_id', $this->class->block_id);
            })
            ->with('class')
            ->get();
    }
}