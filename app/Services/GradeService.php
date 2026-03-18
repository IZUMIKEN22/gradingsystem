<?php
namespace App\Services;

use App\Models\GradingCriteria;
use App\Models\Score;

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

    // -------------------------------
    // Partial grade (midterm or final)
    // -------------------------------
    public function computePartialGrade($student_id, $class_id, $type){
        $criteria = GradingCriteria::where('class_id', $class_id)->get();
        
        $totalPercentage = 0;
        $weightedSum = 0;

        foreach($criteria as $c){
            // Only get assessments of the correct type
            $assessments = $c->assessments()
                             ->where('type', $type) // 'midterm' or 'final'
                             ->get();

            // Skip if no assessments of this type in this criterion
            if ($assessments->isEmpty()) {
                continue;
            }

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
                // Calculate the percentage score for this criterion
                $criterionScore = ($studentTotal / $highestTotal) * 100;
                
                // Add to weighted sum (using the criterion's percentage weight)
                $weightedSum += $criterionScore * ($c->percentage / 100);
                $totalPercentage += $c->percentage;
            }
        }

        // If we have weighted components, calculate the final grade
        if ($totalPercentage > 0) {
            // The grade is the weighted average, scaled to 100%
            // This ensures that if totalPercentage is less than 100%, 
            // we still get a grade out of 100
            $finalGrade = ($weightedSum / $totalPercentage) * 100;
            return round($finalGrade, 2);
        }

        // Return null if no assessments found for this term
        return null;
    }
}