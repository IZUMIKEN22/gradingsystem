<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentList;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\GradingCriteria;
use App\Models\Assessment;

class StudentsController extends Controller
{
    // --------------------------
    // List all students (general)
    // --------------------------
    public function index(Request $request)
{
    $classId = $request->query('class_id'); // Get class_id from URL

    $students = StudentList::when($classId, function ($query, $classId) {
        return $query->where('class_id', $classId);
    })
    ->orderBy('student_name')
    ->get();

    // ✅ TOTAL STUDENTS COUNT
    $totalStudents = StudentList::count();

    return view('students.index', compact('students', 'classId', 'totalStudents'));
}



    // --------------------------
    // List students per class
    // --------------------------
   public function studentsPerClass($class_id)
    {
        $classId = $class_id;

        // Get students in the class
        $students = StudentList::where('class_id', $classId)
            ->orderBy('student_name')
            ->get();

        // ✅ TOTAL STUDENTS PER CLASS
        $totalStudents = StudentList::where('class_id', $classId)->count();

        // Get grading criteria for the class
        $criteriaList = GradingCriteria::where('class_id', $classId)
            ->orderBy('id')
            ->get();

        // Get assessments with their grading criteria
        $assessments = Assessment::with('gradingCriteria')
            ->whereHas('gradingCriteria', function ($q) use ($classId) {
                $q->where('class_id', $classId);
            })
            ->orderBy('id')
            ->get();

        // Pass everything to the view
        return view('students.index', compact(
            'classId',
            'students',
            'criteriaList',
            'assessments',
            'totalStudents'
        ));
    }

    // --------------------------
    // Show student list page for Excel import
    // --------------------------
    public function studentListView(Request $request)
    {
        $classId = $request->query('class_id'); // e.g., /students/import?class_id=1
        $students = StudentList::orderBy('student_name')->get();
        return view('students.import', compact('students', 'classId'));
    }

    // --------------------------
    // Import students from Excel
    // --------------------------
    public function importStudentList(Request $request)
    {
        $request->validate([
            'file_data' => 'required',
            'class_id'  => 'required|exists:classes,class_id',
        ]);

        $classId = $request->class_id;

        try {
            // Decode Base64
            $fileData = base64_decode($request->file_data);
            if (!$fileData) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid file data.'
                ], 422);
            }

            // Save temp file
            $tempFile = storage_path('app/temp_' . Str::random(10) . '.xlsx');
            file_put_contents($tempFile, $fileData);

            // Load spreadsheet
            $spreadsheet = IOFactory::load($tempFile);
            $rows = $spreadsheet->getActiveSheet()->toArray();

            $addedCount = 0;
            $skippedCount = 0;

            foreach ($rows as $index => $row) {
                if ($index < 3) continue; // skip headers
                if (empty($row[2])) continue; // student_number required

                // Skip duplicates
                if (StudentList::where('student_number', $row[2])->where('class_id', $classId)->exists()) {
                    $skippedCount++;
                    continue;
                }

                StudentList::create([
                    'class_id'       => $classId,
                    'reg_number'     => $row[1] ?? null,
                    'student_number' => $row[2],
                    'student_name'   => $row[3] ?? null,
                    'barangay'       => $row[4] ?? null,
                    'city'           => $row[5] ?? null,
                    'province'       => $row[6] ?? null,
                    'date_of_birth'  => $row[7] ?? null,
                    'sex'            => $row[8] ?? null,
                    'mobile_number'  => $row[9] ?? null,
                    'email'          => $row[10] ?? null,
                ]);
                $addedCount++;
            }

            @unlink($tempFile);

            return response()->json([
                'status' => 'success',
                'message' => "Import completed: $addedCount added, $skippedCount skipped (duplicates)."
            ]);

        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            \Log::error('Excel Read Error: ', ['exception' => $e]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to read Excel file: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            \Log::error('Student Import Error: ', ['exception' => $e]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to import students: ' . $e->getMessage()
            ], 500);
        }
    }
    // --------------------------
    // Return students as JSON (for AJAX)
    // --------------------------
    public function getStudents(Request $request)
{
    $classId = $request->query('class_id');

    $students = StudentList::where('class_id', $classId)
        ->with('scores')
        ->select('id',  'student_number', 'student_name')
        ->orderBy('student_name')
        ->get();

$assessments = Assessment::with('gradingCriteria')
    ->whereHas('gradingCriteria', function ($q) use ($classId) {
        $q->where('class_id', $classId);
    })
    ->orderBy('id')
    ->get()
    ->groupBy(fn($a) => $a->gradingCriteria->component_name)
    ->map(fn($group) => $group->map(fn($a) => [
        'id' => $a->id,
        'title' => $a->title,
        'highest_score' => $a->highest_score,
        'type' => $a->type,
        'criteria' => [
            'id' => $a->gradingCriteria->id,
            'component_name' => $a->gradingCriteria->component_name,
            'percentage' => $a->gradingCriteria->percentage,
        ]
    ]));



    return response()->json([
        'students' => $students,
        'assessments' => $assessments
    ]);
}



    // --------------------------
    // Add a student to a class
    // --------------------------
    public function addStudentToClass(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:student_lists,id',
            'class_id'   => 'required|exists:classes,class_id',
        ]);

        $student = StudentList::findOrFail($request->student_id);
        $student->class_id = $request->class_id;
        $student->save();

        return redirect()->back()->with('success', 'Student enrolled to class successfully.');
    }

    // --------------------------
    // CRUD: Store new student
    // --------------------------
    public function store(Request $request)
    {
        $request->validate([
            'student_number' => 'required|unique:student_lists,student_number',
            'student_name'   => 'required',
        ]);

        StudentList::create($request->all());

        return redirect()->back()->with('success', 'Student added successfully.');
    }

    // --------------------------
    // CRUD: Update student
    // --------------------------
    public function update(Request $request, $id)
    {
        $student = StudentList::findOrFail($id);
        $student->update($request->all());

        return redirect()->back()->with('success', 'Student updated successfully.');
    }

    // --------------------------
    // CRUD: Delete student
    // --------------------------
    public function destroy($id)
    {
        $student = StudentList::findOrFail($id);
        $student->delete();

        return redirect()->back()->with('success', 'Student deleted successfully.');
    }

    
}
