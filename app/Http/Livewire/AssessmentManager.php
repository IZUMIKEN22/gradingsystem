<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Assessment;
use App\Models\Criteria;

class AssessmentManager extends Component
{
    public $classId;
    public $title = '';
    public $grading_criteria_id = '';
    public $highest_score = '';
    public $type = '';
    public $date = '';
    public $assessments = [];
    public $criteriaList = [];
    public $criteriaCount = 0;

    protected $listeners = ['refreshAssessments' => 'loadAssessments'];

    public function mount($classId)
    {
        $this->classId = $classId;
        $this->loadCriteria();
        $this->loadAssessments();
    }

    public function loadCriteria()
    {
        $this->criteriaList = Criteria::where('class_id', $this->classId)->get();
        $this->criteriaCount = $this->criteriaList->count();
    }

    public function loadAssessments()
    {
        $this->assessments = Assessment::where('class_id', $this->classId)
            ->with('gradingCriteria')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function addAssessment()
    {
        if ($this->criteriaCount < 3) {
            session()->flash('error', 'You need at least 3 grading components before adding assessments.');
            return;
        }

        $this->validate([
            'title' => 'required|min:2|max:255',
            'grading_criteria_id' => 'required|exists:grading_criterias,id',
            'highest_score' => 'required|numeric|min:1',
            'type' => 'required|in:Midterm,Final',
            'date' => 'required|date',
        ]);

        Assessment::create([
            'class_id' => $this->classId,
            'title' => $this->title,
            'grading_criteria_id' => $this->grading_criteria_id,
            'highest_score' => $this->highest_score,
            'type' => $this->type,
            'date' => $this->date,
        ]);

        $this->reset(['title', 'grading_criteria_id', 'highest_score', 'type', 'date']);
        $this->loadAssessments();
        
        session()->flash('message', 'Assessment added successfully!');
    }

    public function deleteAssessment($id)
    {
        $assessment = Assessment::find($id);
        if ($assessment) {
            $assessment->delete();
            $this->loadAssessments();
            session()->flash('message', 'Assessment deleted successfully!');
        }
    }

    public function render()
    {
        return view('livewire.assessment-manager');
    }
}