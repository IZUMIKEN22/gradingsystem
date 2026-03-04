<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments'; // your table name
    protected $fillable = ['name', 'head']; // adjust according to your table columns

    public function blocks()
    {
        return $this->hasMany(Block::class, 'department_id');
    }

    // Optional: Add relationship to classes if needed
    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'department_id', 'id');
    }
    
}
