<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $primaryKey = 'teacher_id';

    protected $fillable = [
        'name', 'email', 'username', 'password','is_active',
    ];

    protected $hidden = ['password'];

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'teacher_id');
    }

}
