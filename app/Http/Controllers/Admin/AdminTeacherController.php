<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\ClassModel;
use App\Models\StudentList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminTeacherController extends Controller
{
    /**
     * Display a listing of teachers
     */
    public function index(Request $request)
    {
        $teachers = Teacher::withCount('classes')
            ->orderBy('last_activity', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json([
            'success' => true,
            'teachers' => $teachers->map(function($teacher) {
                return [
                    'id' => $teacher->teacher_id,
                    'name' => $teacher->name,
                    'email' => $teacher->email,
                    'username' => $teacher->username,
                    'classes_count' => $teacher->classes_count,
                    'created_at' => $teacher->created_at,
                    'last_activity' => $teacher->last_activity,
                    'is_online' => $teacher->is_online, // Using the accessor
                    'last_seen' => $teacher->last_seen, // Using the accessor
                ];
            })
        ]);
    }

    /**
     * Show the teacher registration form
     */
    public function create()
    {
        return view('admin.teacher-register');
    }

    /**
     * Store a newly created teacher
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers,email',
            'username' => 'required|string|max:255|unique:teachers,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $teacher = Teacher::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'is_active' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Teacher registered successfully!',
                'teacher' => [
                    'teacher_id' => $teacher->teacher_id,
                    'name' => $teacher->name,
                    'email' => $teacher->email,
                    'username' => $teacher->username,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified teacher
     */
    public function show($id)
    {
        try {
            $teacher = Teacher::with(['classes' => function($query) {
                $query->withCount('students');
            }])->findOrFail($id);
            
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'teacher' => [
                        'teacher_id' => $teacher->teacher_id,
                        'name' => $teacher->name,
                        'email' => $teacher->email,
                        'username' => $teacher->username,
                        'created_at' => $teacher->created_at->format('Y-m-d H:i:s'),
                        'last_activity' => $teacher->last_activity,
                        'is_online' => $teacher->is_online,
                        'last_seen' => $teacher->last_seen,
                        'classes' => $teacher->classes->map(function($class) {
                            return [
                                'id' => $class->class_id,
                                'name' => $class->name,
                                'students_count' => $class->students_count,
                            ];
                        }),
                        'classes_count' => $teacher->classes->count(),
                    ]
                ]);
            }
            
            return view('admin.teacher-details', compact('teacher'));
            
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Teacher not found'
                ], 404);
            }
            return redirect()->route('admin.dashboard')->with('error', 'Teacher not found');
        }
    }

    /**
     * Remove the specified teacher
     */
    public function destroy($id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            
            // Check if teacher has classes
            if ($teacher->classes()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'Cannot delete teacher because they have existing classes. Please reassign or delete the classes first.'
                ], 400);
            }

            $teacher->delete();

            return response()->json([
                'success' => true,
                'message' => 'Teacher deleted successfully'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Teacher not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error deleting teacher: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get teacher statistics for dashboard
     */
    public function getStats()
    {
        try {
            $stats = [
                'total_teachers' => Teacher::count(),
                'active_now' => Teacher::where('last_activity', '>=', now()->subMinutes(5))->count(),
                'active_today' => Teacher::where('last_activity', '>=', now()->startOfDay())->count(),
                'total_classes' => ClassModel::count(),
                'total_students' => StudentList::count(),
            ];

            return response()->json($stats);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update teacher's last activity
     */
    public function updateActivity(Request $request, $id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            $teacher->update(['last_activity' => now()]);

            return response()->json([
                'success' => true,
                'message' => 'Activity updated'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}