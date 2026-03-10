<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Teacher;

class TrackTeacherActivity
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('teacher_id')) {
            $teacher = Teacher::find(session('teacher_id'));
            if ($teacher) {
                $teacher->update([
                    'last_activity' => now()
                ]);
            }
        }
        
        return $next($request);
    }
}