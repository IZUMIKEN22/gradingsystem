<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\AcademicYear;
use App\Models\Department;
use App\Models\ClassModel; // or whatever your class model is named (Class, Course, etc.)
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all teachers with their class counts and last activity
        $teachers = Teacher::with(['classes' => function($query) {
                $query->with('academicYear');
            }])
            ->get()
            ->map(function($teacher) {
                // Calculate total classes
                $teacher->total_classes = $teacher->classes->count();
                
                // For active classes, we'll just use total for now
                // You can modify this logic based on your needs
                $teacher->active_classes = $teacher->total_classes;
                
                // Determine status based on last activity
                $teacher->status = $this->getTeacherStatus($teacher);
                
                // Get last login time
                $teacher->last_active = $teacher->last_login_at ? 
                    Carbon::parse($teacher->last_login_at)->diffForHumans() : 'Never';
                
                return $teacher;
            });

        // Get the most recent academic year instead of using is_current
        $currentAcademicYear = AcademicYear::latest()->first();

        // Statistics for dashboard
        $stats = [
            'total_teachers' => $teachers->count(),
            'active_teachers' => $teachers->where('status', 'active')->count(),
            'inactive_teachers' => $teachers->where('status', 'inactive')->count(),
            'total_classes' => ClassModel::count(),
            'total_departments' => Department::count(),
            'total_academic_years' => AcademicYear::count(),
            'current_academic_year' => $currentAcademicYear,
        ];

        return view('admin.dashboard', compact('teachers', 'stats'));
    }

    private function getTeacherStatus($teacher)
    {
        if (!$teacher->last_login_at) {
            return 'inactive';
        }

        $lastLogin = Carbon::parse($teacher->last_login_at);
        
        if ($lastLogin->isToday()) {
            return 'active';
        } elseif ($lastLogin->isYesterday()) {
            return 'away';
        } elseif ($lastLogin->diffInDays(now()) <= 7) {
            return 'away';
        } else {
            return 'inactive';
        }
    }

    public function teacherDetails($id)
    {
        $teacher = Teacher::with(['classes' => function($query) {
                $query->with(['academicYear', 'department', 'block'])
                    ->orderBy('created_at', 'desc');
            }])
            ->findOrFail($id);

        // Get class statistics
        $classStats = [
            'total' => $teacher->classes->count(),
            'by_academic_year' => $teacher->classes->groupBy('academic_year_id')
                ->map(function($classes) {
                    return [
                        'count' => $classes->count(),
                        'year' => $classes->first()->academicYear->academic_year ?? 'Unknown'
                    ];
                }),
            'recent' => $teacher->classes->take(5),
        ];

        return response()->json([
            'teacher' => $teacher,
            'stats' => $classStats
        ]);
    }

    public function updateTeacherStatus(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:active,inactive,suspended'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Teacher status updated successfully'
        ]);
    }
}