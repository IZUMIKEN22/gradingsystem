<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentList extends Model
{
    use HasFactory;

    protected $table = 'student_list'; // make sure table name is correct
    protected $primaryKey = 'id'; // set your table's primary key

    protected $fillable = [
        'class_id',       // <-- include class_id for your import
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

    // Optional: relationship to class
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'class_id');
    }
    public function scores() {
        return $this->hasMany(Score::class, 'student_id');
    }

}
