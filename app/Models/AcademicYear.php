<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = ['academic_year'];

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'academic_year_id');
    }
}
