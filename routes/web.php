<?php

Route::get('/test', function() {
    return 'Laravel is working!';
});

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradingCriteriaController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\GradingSheetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\TeacherController;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::post('/academic-years', [AcademicYearController::class, 'store'])
    ->name('academic-years.store');

Route::get('/', fn() => redirect('/login'));

Route::view('/register', 'register');
Route::post('/register', [AuthController::class, 'register']);

Route::view('/login', 'login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/auth/google', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| Admin Routes - JS Authentication Only (No Laravel middleware)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Your existing routes...
    
    // API routes for admin dashboard with active status
    Route::get('/api/teachers', function() {
        $teachers = App\Models\Teacher::orderBy('last_activity', 'desc')->get();
        return response()->json(['teachers' => $teachers]);
    })->name('api.teachers');
    
    Route::get('/api/stats', function() {
        $now = now();
        $today = now()->startOfDay();
        
        return response()->json([
            'total_teachers' => App\Models\Teacher::count(),
            'active_now' => App\Models\Teacher::where('last_activity', '>=', now()->subMinutes(5))->count(),
            'active_today' => App\Models\Teacher::where('last_activity', '>=', $today)->count(),
            'total_classes' => App\Models\ClassModel::count(),
            'total_students' => App\Models\StudentList::count(),
        ]);
    })->name('api.stats');
}); 
/*
|--------------------------------------------------------------------------
| Protected teacher routes
|--------------------------------------------------------------------------
*/

Route::middleware('teacherAuth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // =======================
    // CLASSES (Dashboard & List)
    // =======================
    Route::get('/dashboard', [ClassController::class, 'index'])->name('dashboard');
    Route::get('/classes', [ClassController::class, 'classList'])->name('classes.index');
    Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{id}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');

    // =======================
    // GRADING FLOW
    // =======================
    Route::get('/criteria/{class_id}', [GradingCriteriaController::class, 'index'])->name('criteria.index');
    Route::post('/criteria/store', [GradingCriteriaController::class, 'store'])->name('criteria.store');
    Route::get('/criteria/list', [GradingCriteriaController::class, 'list'])->name('criteria.list');

    // =======================
    // ASSESSMENTS CRUD
    // =======================
    Route::post('/assessments/store', [AssessmentController::class, 'store'])->name('assessments.store');
    Route::get('/assessments/list', [AssessmentController::class, 'getByClass'])->name('assessments.get');
    Route::get('/assessments/{id}/edit', [AssessmentController::class, 'edit'])->name('assessments.edit');
    Route::put('/assessments/{id}', [AssessmentController::class, 'update'])->name('assessments.update');
    Route::delete('/assessments/{id}', [AssessmentController::class, 'destroy'])->name('assessments.destroy');


    // =======================
    // GRADING SHEET
    // =======================
    Route::get('/grading-sheet/{class_id}', [GradingSheetController::class, 'show'])->name('grading.sheet');
    Route::get('/grading-sheet/midterm/{class_id}', [GradingSheetController::class, 'midterm'])->name('grading.sheet_midterm');
    Route::get('/grading-sheet/final/{class_id}', [GradingSheetController::class, 'final'])->name('grading.sheet_final');
    Route::get('grades/{class_id}/download-midterm', [GradingSheetController::class, 'downloadMidterm'])->name('grades.download.midterm');
    Route::get('grades/{class_id}/download-final', [GradingSheetController::class, 'downloadFinal'])->name('grades.download.final');
    Route::get('grades/{class_id}/download-full', [GradingSheetController::class, 'downloadFull'])->name('grades.download.full');

    // =======================
    // STUDENTS (PER CLASS)
    // =======================
    Route::get('/classes/{class_id}/students', [StudentsController::class, 'studentsPerClass'])->name('class.students');
    Route::post('/class/enroll', [StudentsController::class, 'addStudentToClass'])->name('class.enroll');

    // =======================
    // STUDENT MASTER LIST
    // =======================
    Route::get('/students', [StudentsController::class, 'index'])->name('students.index');
    Route::post('/students', [StudentsController::class, 'store'])->name('students.store');
    Route::put('/students/{id}', [StudentsController::class, 'update'])->name('students.update');
    Route::delete('/students/{id}', [StudentsController::class, 'destroy'])->name('students.destroy');
    Route::post('/students/import', [StudentsController::class, 'importStudentList'])->name('studentlist.import');
    Route::get('/students/get', [StudentsController::class, 'getStudents'])->name('students.get');

    // =======================
    // SCORES
    // =======================
    Route::post('/scores', [ScoreController::class, 'store'])->name('scores.store');

    // =======================
    // AJAX ROUTES
    // =======================
    Route::get('/departments/{department}/blocks', [ClassController::class, 'getBlocks']);

    // =======================
    // SETTINGS & PROFILE MANAGEMENT
    // =======================
    Route::get('/settings', [TeacherController::class, 'settings'])->name('settings');
    Route::put('/settings/profile', [TeacherController::class, 'updateProfile'])->name('settings.profile.update');

    // Department management - INDIVIDUAL ROUTES FIRST, THEN BULK
    Route::delete('/settings/departments/delete-all', [TeacherController::class, 'destroyAllDepartments'])->name('settings.departments.delete-all');
    Route::post('/settings/departments', [TeacherController::class, 'storeDepartment'])->name('settings.departments.store');
    Route::put('/settings/departments/{id}', [TeacherController::class, 'updateDepartment'])->name('settings.departments.update');
    Route::delete('/settings/departments/{id}', [TeacherController::class, 'destroyDepartment'])->name('settings.departments.destroy');

    // Block management - INDIVIDUAL ROUTES FIRST, THEN BULK
    Route::delete('/settings/blocks/delete-all', [TeacherController::class, 'destroyAllBlocks'])->name('settings.blocks.delete-all');
    Route::post('/settings/blocks', [TeacherController::class, 'storeBlock'])->name('settings.blocks.store');
    Route::put('/settings/blocks/{id}', [TeacherController::class, 'updateBlock'])->name('settings.blocks.update');
    Route::delete('/settings/blocks/{id}', [TeacherController::class, 'destroyBlock'])->name('settings.blocks.destroy');

    Route::get('/classes/{class}/students', [ClassController::class, 'students'])->name('classes.students');
});