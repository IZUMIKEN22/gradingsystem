<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\ClassModel;
use App\Models\Department; // Add this
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::with('academicYear')
            ->where('teacher_id', session('teacher_id'))
            ->get();

        $academicYears = AcademicYear::withCount('classes')
            ->orderBy('academic_year', 'desc')
            ->get();

        // ✅ Fetch all departments
        $departments = Department::all();

        // Pass departments to the view
        return view('dashboard', compact('classes', 'academicYears', 'departments'));
    }

    // Add this method to your existing ClassController.php

public function classList(Request $request)
{
    $query = ClassModel::with(['academicYear', 'department', 'block'])
        ->where('teacher_id', session('teacher_id'));
    
    // Apply filters
    if ($request->filled('academic_year')) {
        $query->where('academic_year_id', $request->academic_year);
    }
    
    if ($request->filled('department')) {
        $query->where('department_id', $request->department);
    }
    
    if ($request->filled('semester')) {
        $query->where('semester', $request->semester);
    }
    
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('subject_code', 'LIKE', "%{$search}%")
              ->orWhere('subject_description', 'LIKE', "%{$search}%")
              ->orWhere('section', 'LIKE', "%{$search}%");
        });
    }
    
    $classes = $query->orderBy('created_at', 'desc')->get();
    
    // Get filter data
    $academicYears = AcademicYear::orderBy('academic_year', 'desc')->get();
    $departments = Department::all();
    
    return view('classes.index', compact('classes', 'academicYears', 'departments'));
}

    public function store(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'semester' => 'required',
            'department_id' => 'required|exists:departments,id',
            'block_id' => 'required|exists:blocks,id', // use block_id
            'section' => 'required',
            'subject_code' => 'required',
            'subject_description' => 'required',
            'credits' => 'required|numeric|min:1|max:5',
            'schedule_date' => 'required',
            'schedule_time' => 'required',
        ]);

        $exists = ClassModel::where('teacher_id', session('teacher_id'))
            ->where('academic_year_id', $request->academic_year_id)
            ->where('semester', $request->semester)
            ->where('department_id', $request->department_id)
            ->where('block_id', $request->block_id) // check using block_id
            ->where('section', $request->section)
            ->where('subject_code', $request->subject_code)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This class already exists!');
        }

        ClassModel::create([
            'teacher_id' => session('teacher_id'),
            'academic_year_id' => $request->academic_year_id,
            'semester' => $request->semester,
            'department_id' => $request->department_id,
            'block_id' => $request->block_id, // store block_id
            'section' => $request->section,
            'subject_code' => $request->subject_code,
            'subject_description' => $request->subject_description,
            'credits' => $request->credits,
            'schedule_date' => $request->schedule_date,
            'schedule_time' => $request->schedule_time,
        ]);

        return back()->with('success', 'Class Added');
    }


    public function edit($id)
    {
        $class = ClassModel::where('class_id', $id)
            ->where('teacher_id', session('teacher_id'))
            ->firstOrFail();

        // Add these lines to get data for dropdowns
        $academicYears = AcademicYear::orderBy('academic_year', 'desc')->get();
        $departments = Department::all();
        $blocks = \App\Models\Block::where('department_id', $class->department_id)->get();

        return view('class_edit', compact('class', 'academicYears', 'departments', 'blocks'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'academic_year_id' => 'required|exists:academic_years,id', // Add this
        'semester' => 'required',
        'department_id' => 'required|exists:departments,id',
        'block_id' => 'required|exists:blocks,id',
        'section' => 'required',
        'subject_code' => 'required',
        'subject_description' => 'required',
        'credits' => 'required|numeric|min:1|max:5', // Fix min/max values
        'schedule_date' => 'required', // Add this
        'schedule_time' => 'required', // Add this
    ]);

    $exists = ClassModel::where('teacher_id', session('teacher_id'))
        ->where('academic_year_id', $request->academic_year_id) // Add this
        ->where('semester', $request->semester) // Add this
        ->where('department_id', $request->department_id)
        ->where('block_id', $request->block_id)
        ->where('section', $request->section)
        ->where('subject_code', $request->subject_code)
        ->where('class_id', '!=', $id)
        ->exists();

    if ($exists) {
        return back()->with('error', 'This class already exists!');
    }

    ClassModel::where('class_id', $id)
        ->where('teacher_id', session('teacher_id'))
        ->update([
            'academic_year_id' => $request->academic_year_id, // Add this
            'semester' => $request->semester,
            'department_id' => $request->department_id,
            'block_id' => $request->block_id,
            'section' => $request->section,
            'subject_code' => $request->subject_code,
            'subject_description' => $request->subject_description,
            'credits' => $request->credits,
            'schedule_date' => $request->schedule_date, // Add this
            'schedule_time' => $request->schedule_time, // Add this
        ]);

    return redirect()->route('classes.index')->with('success', 'Class Updated Successfully');
}


    public function destroy($id)
    {
        ClassModel::where('class_id', $id)
            ->where('teacher_id', session('teacher_id'))
            ->delete();

        return back()->with('success', 'Class Deleted');
    }

    public function getBlocks($department_id)
    {
        $blocks = \App\Models\Block::where('department_id', $department_id)->get();
        return response()->json($blocks);
    }

}
