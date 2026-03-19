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
            $query->where(function ($q) use ($search) {
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
    try {
        // Log all incoming data
        \Log::info('========== STORE METHOD CALLED ==========');
        \Log::info('Request data:', $request->all());
        \Log::info('Session teacher_id: ' . session('teacher_id'));

        // Validate
        $validated = $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'semester' => 'required',
            'department_id' => 'required|exists:departments,id',
            'block_id' => 'required|exists:blocks,id',
            'section' => 'required',
            'subject_code' => 'required',
            'subject_description' => 'required',
            'credits' => 'required|numeric|min:1|max:5',
            'lab' => 'nullable|in:3,N/A',
            'schedule_date' => 'required',
            'schedule_time' => 'required',
        ]);

        \Log::info('Validation passed', $validated);

        // Check if teacher is logged in
        if (!session()->has('teacher_id')) {
            \Log::error('No teacher_id in session');
            return back()->with('error', 'You must be logged in as a teacher')->withInput();
        }

        // Check for duplicate subject
        $existingSubject = ClassModel::where('teacher_id', session('teacher_id'))
            ->where('academic_year_id', $request->academic_year_id)
            ->where('semester', $request->semester)
            ->where('department_id', $request->department_id)
            ->where('block_id', $request->block_id)
            ->where('subject_code', $request->subject_code)
            ->exists();

        \Log::info('Duplicate check result: ' . ($existingSubject ? 'DUPLICATE FOUND' : 'NO DUPLICATE'));

        if ($existingSubject) {
            return back()->with('error', 'This subject is already offered to this block in the same academic year and semester!')->withInput();
        }

        // Create the class
        $class = ClassModel::create([
            'teacher_id' => session('teacher_id'),
            'academic_year_id' => $request->academic_year_id,
            'semester' => $request->semester,
            'department_id' => $request->department_id,
            'block_id' => $request->block_id,
            'section' => $request->section,
            'subject_code' => $request->subject_code,
            'subject_description' => $request->subject_description,
            'credits' => $request->credits,
            'lab' => $request->lab ?? 'N/A',
            'schedule_date' => $request->schedule_date,
            'schedule_time' => $request->schedule_time,
        ]);

        \Log::info('Class created successfully with ID: ' . $class->class_id);

        return back()->with('success', 'Class Added Successfully');

    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation failed:', $e->errors());
        return back()->withErrors($e->errors())->withInput();

    } catch (\Exception $e) {
        \Log::error('Error creating class: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        return back()->with('error', 'Failed to create class: ' . $e->getMessage())->withInput();
    }
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
            'academic_year_id' => 'required|exists:academic_years,id',
            'semester' => 'required',
            'department_id' => 'required|exists:departments,id',
            'block_id' => 'required|exists:blocks,id',
            'section' => 'required',
            'subject_code' => 'required',
            'subject_description' => 'required',
            'credits' => 'required|numeric|min:1|max:5',
            'lab' => 'nullable|in:3,N/A',
            'schedule_date' => 'required',
            'schedule_time' => 'required',
        ]);

        // Check if this BLOCK already has this SAME SUBJECT (excluding current class)
        // Removed 'section' from the check
        $existingSubject = ClassModel::where('teacher_id', session('teacher_id'))
            ->where('academic_year_id', $request->academic_year_id)
            ->where('semester', $request->semester)
            ->where('department_id', $request->department_id)
            ->where('block_id', $request->block_id)
            ->where('subject_code', $request->subject_code)
            ->where('class_id', '!=', $id)
            ->exists();

        if ($existingSubject) {
            return back()->with('error', 'This subject is already offered to this block in the same academic year and semester!');
        }

        ClassModel::where('class_id', $id)
            ->where('teacher_id', session('teacher_id'))
            ->update([
                'academic_year_id' => $request->academic_year_id,
                'semester' => $request->semester,
                'department_id' => $request->department_id,
                'block_id' => $request->block_id,
                'section' => $request->section,
                'subject_code' => $request->subject_code,
                'subject_description' => $request->subject_description,
                'credits' => $request->credits,
                'lab' => $request->lab ?? 'N/A',
                'schedule_date' => $request->schedule_date,
                'schedule_time' => $request->schedule_time,
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
