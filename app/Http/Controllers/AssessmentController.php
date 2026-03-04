<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\GradingCriteria;
use Carbon\Carbon;

class AssessmentController extends Controller
{
    // ==============================
    // STORE
    // ==============================
   public function store(Request $request)
{
    try {
        $request->validate([
            'class_id' => 'required|exists:classes,class_id',
            'title' => 'required|string|max:255',
            'grading_criteria_id' => 'required|exists:grading_criterias,id',
            'highest_score' => 'required|numeric|min:1',
            'type' => 'required|in:Midterm,Final',
            'date' => 'required|date',
        ]);

        $classId = $request->class_id;

        $criteriaCount = GradingCriteria::where('class_id', $classId)->count();
        $totalPercentage = GradingCriteria::where('class_id', $classId)->sum('percentage');

        if ($criteriaCount < 3) {
            return response()->json([
                'success' => false,
                'errors' => ['general' => 'At least 3 grading components are required.'],
                'message' => 'At least 3 grading components are required.'
            ], 422);
        }

        if ($totalPercentage != 100) {
            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Total grading percentage must be exactly 100%. Current total: ' . $totalPercentage . '%'],
                'message' => 'Total grading percentage must be exactly 100%. Current total: ' . $totalPercentage . '%'
            ], 422);
        }

        $assessment = Assessment::create([
            'class_id' => $classId,
            'grading_criteria_id' => $request->grading_criteria_id,
            'title' => $request->title,
            'highest_score' => $request->highest_score,
            'type' => $request->type,
            'date' => $request->date,
        ]);

        // Load the relationship
        $assessment->load('gradingCriteria');

        return response()->json([
            'success' => true,
            'message' => 'Assessment created successfully!',
            'assessment' => $assessment
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        \Log::error('Assessment store error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error creating assessment: ' . $e->getMessage()
        ], 500);
    }
}

    // ==============================
    // EDIT (SHOW FORM)
    // ==============================
    public function edit($id)
{
    $assessment = Assessment::with('gradingCriteria')->findOrFail($id);
    $criteria = GradingCriteria::where('class_id', $assessment->class_id)->get();

    return response()->json([
        'assessment' => [
            'id' => $assessment->id,
            'title' => $assessment->title,
            'grading_criteria_id' => $assessment->grading_criteria_id,
            'highest_score' => $assessment->highest_score,
            'type' => $assessment->type,
            'date' => $assessment->date?->format('Y-m-d'),
        ],
        'criteria' => $criteria
    ]);
}


    // ==============================
    // UPDATE
    // ==============================
   // Sa AssessmentController.php
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'highest_score' => 'required|numeric|min:0',
        'type' => 'required|string|in:Midterm,Final',
        'date' => 'required|date',
        'grading_criteria_id' => 'required|exists:grading_criterias,id' // DAPAT grading_criterias (PLURAL)
    ]);

    $assessment = Assessment::findOrFail($id);
    $assessment->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Assessment updated successfully!'
    ]);
}

    // ==============================
    // DELETE
    // ==============================
    public function destroy($id)
    {
        $assessment = Assessment::findOrFail($id);
        $assessment->delete();

        return redirect()->back()->with('success', 'Assessment deleted successfully!');
    }

    
}
