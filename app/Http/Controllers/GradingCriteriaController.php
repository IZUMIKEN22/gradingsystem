<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\GradingCriteria;

class GradingCriteriaController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'component_name' => 'required',
            'percentage' => 'required|integer|min:1|max:100'
        ]);

        GradingCriteria::create([
            'class_id' => $request->class_id,
            'component_name' => $request->component_name,
            'percentage' => $request->percentage
        ]);

        return back()->with('success', 'criteria added!');
    }

    public function index($class_id){
        $criteriaList = GradingCriteria::where('class_id', $class_id)->get();
        return view('grading.criteria', compact('criteriaList', 'class_id'));
    }

    public function getByClass(Request $request)
    {
        \Log::info('class_id = '.$request->query('class_id'));
        $criteria = GradingCriteria::where('class_id', $request->query('class_id'))->get();
        \Log::info('criteria = '.json_encode($criteria));
        return response()->json($criteria);
    }

}
