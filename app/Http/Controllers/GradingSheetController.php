<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentList;
use App\Services\GradeService;
use App\Models\ClassModel;
use Illuminate\Support\Facades\File;
use PDF;

class GradingSheetController extends Controller
{
    protected $gradeService;

    public function __construct(GradeService $gradeService)
    {
        $this->gradeService = $gradeService;
    }

    public function midterm($class_id)
    {
        $students = StudentList::where('class_id', $class_id)
            ->orderBy('Student_name')
            ->get();

        foreach ($students as $student) {
            $student->midterm_grade = $this->gradeService
                ->computePartialGrade($student->id, $class_id, 'midterm');
        }

        // Fetch class info with academic year and teacher
        $class = ClassModel::with(['teacher', 'academicYear'])->findOrFail($class_id);

        $subject_code = $class->subject_code;
        $subject_description = $class->subject_description;
        $semester = $class->semester;
        $department = $class->department->name ?? 'N/A';
        $head_of_department = $class->department->head ?? 'N/A';
        $block = $class->block->name ?? 'N/A';
        $section = $class->section;
        $schedule_time = $class->schedule_time;
        $schedule_date = $class->schedule_date;
        $name = $class->teacher->name ?? 'N/A';
        $academic_year = $class->academicYear->academic_year ?? 'N/A';

        return view('grading.sheet_midterm', compact(
            'students',
            'class_id',
            'subject_code',
            'subject_description',
            'department',
            'head_of_department',
            'semester',
            'block',
            'section',
            'schedule_time',
            'schedule_date',
            'name',
            'academic_year'
        ));
    }


    public function final($class_id)
    {
        $students = StudentList::where('class_id', $class_id)
            ->orderBy('Student_name')
            ->get();

        foreach ($students as $student) {
            $student->final_grade = $this->gradeService
                ->computePartialGrade($student->id, $class_id, 'final');
        }

        // Fetch class info with academic year and teacher
        $class = ClassModel::with(['teacher', 'academicYear'])->findOrFail($class_id);

        $subject_code = $class->subject_code;
        $subject_description = $class->subject_description;
        $semester = $class->semester;
        $department = $class->department->name ?? 'N/A';
        $head_of_department = $class->department->head ?? 'N/A';
        $block = $class->block->name ?? 'N/A';
        $section = $class->section;
        $schedule_time = $class->schedule_time;
        $schedule_date = $class->schedule_date;
        $name = $class->teacher->name ?? 'N/A';
        $academic_year = $class->academicYear->academic_year ?? 'N/A';

        return view('grading.sheet_final', compact(
            'students',
            'class_id',
            'subject_code',
            'subject_description',
            'department',
            'head_of_department',
            'semester',
            'block',
            'section',
            'schedule_time',
            'schedule_date',
            'name',
            'academic_year'
        ));
    }


    // Show both Midterm and Final grades
    public function show($class_id)
    {
        // Fetch students in the class
        $students = StudentList::where('class_id', $class_id)
            ->orderBy('Student_name')
            ->get();

        foreach ($students as $student) {
            // Midterm partial
            $student->midterm_grade = $this->gradeService
                ->computePartialGrade($student->id, $class_id, 'midterm');

            // Final partial
            $student->final_partial = $this->gradeService
                ->computePartialGrade($student->id, $class_id, 'final');

            // Overall Final Grade
            $student->final_grade = $this->gradeService
                ->computeFinalGrade($student->id, $class_id);
        }

        // Statistics based on final grade
        $passed = $students->where('final_grade', '>=', 75)->count();
        $failed = $students->where('final_grade', '<', 75)->count();
        $total = $students->count();
        $conditionals = $students->where('final_grade', null)->count();
        $dropped = 0;
        $incomplete = 0;

        // Fetch class info with academic year and teacher
        $class = ClassModel::with(['teacher', 'academicYear'])->findOrFail($class_id);

        $subject_code = $class->subject_code;
        $subject_description = $class->subject_description;
        $semester = $class->semester;
        $department = $class->department->name ?? 'N/A';
        $head_of_department = $class->department->head ?? 'N/A';
        $block = $class->block->name ?? 'N/A';
        $section = $class->section;
        $schedule_time = $class->schedule_time;
        $schedule_date = $class->schedule_date;
        $name = $class->teacher->name ?? 'N/A';
        $academic_year = $class->academicYear->academic_year ?? 'N/A';

        return view('grading.sheet', compact(
            'students',
            'passed',
            'failed',
            'total',
            'conditionals',
            'dropped',
            'incomplete',
            'class_id',
            'subject_code',
            'subject_description',
            'department',
            'head_of_department',
            'semester',
            'block',
            'section',
            'schedule_time',
            'schedule_date',
            'name',
            'academic_year'
        ));
    }

    public function downloadMidterm($class_id)
    {
        $students = StudentList::where('class_id', $class_id)
            ->orderBy('Student_name')
            ->get();

        foreach ($students as $student) {
            $student->midterm_grade = $this->gradeService
                ->computePartialGrade($student->id, $class_id, 'midterm');
        }

        // Fetch class info
        $class = ClassModel::with(['teacher', 'academicYear'])->findOrFail($class_id);

        $subject_code = $class->subject_code;
        $subject_description = $class->subject_description;
        $semester = $class->semester;
        $department = $class->department->name ?? 'N/A';
        $head_of_department = $class->department->head ?? 'N/A';
        $block = $class->block->name ?? 'N/A';
        $section = $class->section;
        $schedule_time = $class->schedule_time;
        $schedule_date = $class->schedule_date;
        $name = $class->teacher->name ?? 'N/A';
        $academic_year = $class->academicYear->academic_year ?? 'N/A';

        // Base64 images
        $headerBase64 = 'data:image/jpeg;base64,' . base64_encode(File::get(public_path('images/header.jpg')));
        $footerBase64 = 'data:image/jpeg;base64,' . base64_encode(File::get(public_path('images/footer.jpg')));

        $pdf = Pdf::loadView(
            'grading.pdf.sheet_midterm_full',
            compact(
                'students',
                'class_id',
                'subject_code',
                'subject_description',
                'department',
                'head_of_department',
                'semester',
                'block',
                'section',
                'schedule_time',
                'schedule_date',
                'name',
                'academic_year',
                'headerBase64',
                'footerBase64'
            )
        )
            ->setPaper([0, 0, 612, 936], 'portrait')
            ->setOption('dpi', 72);

        return $pdf->download('Grading_Sheet_Midterm.pdf');
    }

    public function downloadFinal($class_id)
    {
        $students = StudentList::where('class_id', $class_id)
            ->orderBy('Student_name')
            ->get();

        foreach ($students as $student) {
            $student->final_grade = $this->gradeService
                ->computePartialGrade($student->id, $class_id, 'final');
        }

        // Fetch class info
        $class = ClassModel::with(['teacher', 'academicYear'])->findOrFail($class_id);

        $subject_code = $class->subject_code;
        $subject_description = $class->subject_description;
        $semester = $class->semester;
        $department = $class->department->name ?? 'N/A';
        $head_of_department = $class->department->head ?? 'N/A';
        $block = $class->block->name ?? 'N/A';
        $section = $class->section;
        $schedule_time = $class->schedule_time;
        $schedule_date = $class->schedule_date;
        $name = $class->teacher->name ?? 'N/A';
        $academic_year = $class->academicYear->academic_year ?? 'N/A';

        // Base64 images
        $headerBase64 = 'data:image/jpeg;base64,' . base64_encode(File::get(public_path('images/header.jpg')));
        $footerBase64 = 'data:image/jpeg;base64,' . base64_encode(File::get(public_path('images/footer.jpg')));

        $pdf = Pdf::loadView(
            'grading.pdf.sheet_final_full',
            compact(
                'students',
                'class_id',
                'subject_code',
                'subject_description',
                'department',
                'head_of_department',
                'semester',
                'block',
                'section',
                'schedule_time',
                'schedule_date',
                'name',
                'academic_year',
                'headerBase64',
                'footerBase64'
            )
        )
            ->setPaper([0, 0, 612, 936], 'portrait')
            ->setOption('dpi', 72);

        return $pdf->download('Grading_Sheet_Finals.pdf');
    }

    public function downloadFull($class_id)
{
    try {
        \Log::info('Starting downloadFull for class_id: ' . $class_id);
        
        // Check if class exists
        $class = ClassModel::with(['teacher', 'academicYear'])->find($class_id);
        if (!$class) {
            \Log::error('Class not found: ' . $class_id);
            return response()->json(['error' => 'Class not found'], 404);
        }
        \Log::info('Class found: ' . $class->subject_code);
        
        // Check if students exist
        $students = StudentList::where('class_id', $class_id)->get();
        \Log::info('Students found: ' . $students->count());
        
        if ($students->isEmpty()) {
            return response()->json(['error' => 'No students in this class'], 404);
        }
        
        // Compute grades for each student
        foreach ($students as $student) {
            $student->midterm_grade = $this->gradeService
                ->computePartialGrade($student->id, $class_id, 'midterm');
            $student->final_grade = $this->gradeService
                ->computePartialGrade($student->id, $class_id, 'final');
        }
        
        // Check if view exists
        $viewPath = 'grading.pdf.sheet_full';
        if (!view()->exists($viewPath)) {
            \Log::error('View not found: ' . $viewPath);
            return response()->json(['error' => 'PDF view not found'], 500);
        }
        \Log::info('View exists: ' . $viewPath);
        
        // Check images
        $headerPath = public_path('images/header.jpg');
        $footerPath = public_path('images/footer.jpg');
        
        \Log::info('Header image exists: ' . (file_exists($headerPath) ? 'Yes' : 'No'));
        \Log::info('Footer image exists: ' . (file_exists($footerPath) ? 'Yes' : 'No'));
        
        // Prepare data for view
        $data = [
            'students' => $students,
            'class_id' => $class_id,
            'subject_code' => $class->subject_code,
            'subject_description' => $class->subject_description,
            'department' => $class->department->name ?? 'N/A',
            'head_of_department' => $class->department->head ?? 'N/A',
            'semester' => $class->semester,
            'block' => $class->block->name ?? 'N/A',
            'section' => $class->section,
            'schedule_time' => $class->schedule_time,
            'schedule_date' => $class->schedule_date,
            'name' => $class->teacher->name ?? 'N/A',
            'academic_year' => $class->academicYear->academic_year ?? 'N/A',
        ];
        
        // Add images if they exist
        if (file_exists($headerPath)) {
            $data['headerBase64'] = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($headerPath));
        }
        if (file_exists($footerPath)) {
            $data['footerBase64'] = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($footerPath));
        }
        
        \Log::info('Generating PDF...');
        
        $pdf = PDF::loadView($viewPath, $data)
            ->setPaper([0, 0, 612, 936], 'portrait')
            ->setOption('dpi', 72);
        
        \Log::info('PDF generated successfully');
        
        return $pdf->download('Grading_Sheet_Midterm_Finals.pdf');
        
    } catch (\Exception $e) {
        \Log::error('PDF Generation Error: ' . $e->getMessage());
        \Log::error('Error trace: ' . $e->getTraceAsString());
        
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
}

}
