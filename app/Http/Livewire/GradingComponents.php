<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Criteria; // Import ito

class GradingComponents extends Component
{
    public $classId;
    public $name = '';
    public $weight = '';
    public $criteriaList = [];
    public $totalPercentage = 0;
    public $remaining = 100;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($classId)
    {
        $this->classId = $classId;
        $this->loadComponents();
    }

    public function loadComponents()
    {
        // Gamitin ang Criteria model
        $this->criteriaList = Criteria::where('class_id', $this->classId)->get();
        $this->totalPercentage = $this->criteriaList->sum('percentage');
        $this->remaining = 100 - $this->totalPercentage;
    }

    public function addComponent()
    {
        $this->validate([
            'name' => 'required|min:2|max:255',
            'weight' => 'required|numeric|min:1|max:' . $this->remaining,
        ]);

        // Save to grading_criterias table
        Criteria::create([
            'class_id' => $this->classId,
            'component_name' => $this->name,
            'percentage' => $this->weight,
        ]);

        $this->name = '';
        $this->weight = '';
        
        $this->loadComponents();
        
        session()->flash('message', 'Component added successfully!');
    }

    public function deleteComponent($id)
    {
        $component = Criteria::find($id);
        if ($component) {
            $component->delete();
            $this->loadComponents();
            session()->flash('message', 'Component deleted successfully!');
        }
    }

    public function render()
    {
        return view('livewire.grading-components');
    }
}