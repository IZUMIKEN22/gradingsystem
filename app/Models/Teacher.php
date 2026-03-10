<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $primaryKey = 'teacher_id';

    protected $fillable = [
        'name', 'email', 'username', 'password','is_active','last_activity',
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'last_activity' => 'datetime',
    ];

     // Accessor for online status
    public function getIsOnlineAttribute()
    {
        if (!$this->last_activity) {
            return false;
        }
        
        // Online if active in last 5 minutes
        return $this->last_activity->gt(now()->subMinutes(5));
    }

    // Get last seen human readable
    public function getLastSeenAttribute()
    {
        if (!$this->last_activity) {
            return 'Never';
        }
        
        return $this->last_activity->diffForHumans();
    }

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'teacher_id');
    }

}
