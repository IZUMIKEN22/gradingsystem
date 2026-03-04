<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $primaryKey = 'score_id'; // ✅ tell Eloquent the PK
    protected $fillable = ['assessment_id', 'student_id', 'score'];

    public function student() {
        return $this->belongsTo(\App\Models\StudentList::class, 'student_id');
    }

    public function assessment() {
        return $this->belongsTo(\App\Models\Assessment::class, 'assessment_id');
    }
}

