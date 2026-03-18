<?php
namespace App\Services;

use App\Models\GradingCriteria;
use App\Models\Score;
use App\Models\Assessment;
use Illuminate\Support\Facades\Log;

class GradeService {

    public function computeFinalGrade($student_id, $class_id){
        $criteria = GradingCriteria::where('class_id', $class_id)->get();
        $final = 0;

        foreach($criteria as $c){
            $assessments = $c->assessments;
            $studentTotal = 0;
            $highestTotal = 0;

            foreach($assessments as $a){
                $highestTotal += $a->highest_score;
                $score = Score::where('assessment_id', $a->id)
                        ->where('student_id', $student_id)
                        ->value('score') ?? 0;
                $studentTotal += $score;
            }

            if($highestTotal > 0){
                $componentGrade = ($studentTotal / $highestTotal) * $c->percentage;
                $final += $componentGrade;
            }
        }
        return round($final, 2);
    }

    public function computePartialGrade($student_id, $class_id, $type)
    {
        // Debug: Log the input
        Log::info("computePartialGrade - Student: $student_id, Class: $class_id, Type: $type");
        
        $criteria = GradingCriteria::where('class_id', $class_id)->get();
        
        if ($criteria->isEmpty()) {
            Log::warning("No grading criteria found for class $class_id");
            return 0; // Return 0 instead of null to avoid 5.00
        }
        
        $totalPercentage = 0;
        $weightedSum = 0;
        $hasAnyAssessments = false;

        foreach ($criteria as $c) {
            // Get assessments of the correct type
            $assessments = Assessment::where('grading_criteria_id', $c->id)
                                     ->where('type', $type)
                                     ->get();

            if ($assessments->isEmpty()) {
                continue;
            }
            
            $hasAnyAssessments = true;

            $studentTotal = 0;
            $highestTotal = 0;

            foreach ($assessments as $a) {
                $highestTotal += $a->highest_score;
                
                $score = Score::where('assessment_id', $a->id)
                        ->where('student_id', $student_id)
                        ->value('score');
                
                // If score is null, treat as 0
                $studentTotal += $score ?? 0;
                
                Log::info("Assessment: {$a->name}, Score: " . ($score ?? '0') . "/{$a->highest_score}");
            }

            if ($highestTotal > 0) {
                // Calculate percentage for this criterion (0-100)
                $criterionPercentage = ($studentTotal / $highestTotal) * 100;
                
                // Add to weighted sum (criterion percentage * its weight)
                $weightedSum += $criterionPercentage * ($c->percentage / 100);
                $totalPercentage += $c->percentage;
                
                Log::info("Criterion: {$c->name}, Student Total: $studentTotal/$highestTotal = " . round($criterionPercentage, 2) . "%, Weight: {$c->percentage}%");
            }
        }

        // If no assessments found for this type, return 0
        if (!$hasAnyAssessments) {
            Log::warning("No $type assessments found for class $class_id");
            return 0;
        }

        // If we have weighted components, calculate the final grade
        if ($totalPercentage > 0) {
            // Calculate weighted average and ensure it's between 0-100
            $finalGrade = ($weightedSum / $totalPercentage) * 100;
            
            // Ensure grade is within 0-100 range
            $finalGrade = max(0, min(100, $finalGrade));
            
            Log::info("Final $type grade: " . round($finalGrade, 2));
            
            return round($finalGrade, 2);
        }

        // If totalPercentage is 0 (shouldn't happen if hasAnyAssessments is true), return 0
        return 0;
    }
}