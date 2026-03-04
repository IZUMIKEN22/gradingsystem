<?php
// app/Http/Controllers/TeacherController.php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Department;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Show settings page with profile and department/block management
     */
    public function settings()
    {
        // Get the logged-in teacher
        $teacher = Teacher::find(session('teacher_id'));
        
        if (!$teacher) {
            return redirect('/login')->with('error', 'Teacher not found');
        }
        
        // Get all departments with their blocks
        $departments = Department::with('blocks')->get();
        
        // If no departments exist, create an empty collection
        if ($departments->isEmpty()) {
            $departments = collect([]);
        }
        
        return view('settings', compact('teacher', 'departments'));
    }

    /**
     * Update teacher profile
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . session('teacher_id') . ',teacher_id',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $teacher = Teacher::find(session('teacher_id'));

        // Check current password if trying to change password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $teacher->password)) {
                return back()->with('error', 'Current password is incorrect');
            }
            $teacher->password = Hash::make($request->new_password);
        }

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->save();

        // Update session
        session(['teacher_name' => $teacher->name]);

        return back()->with('success', 'Profile updated successfully');
    }

    /**
     * Store a new department
     */
    public function storeDepartment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments',
            'head' => 'nullable|string|max:255',
        ]);

        Department::create([
            'name' => $request->name,
            'head' => $request->head,
        ]);

        return back()->with('success', 'Department added successfully');
    }

    /**
     * Update a department
     */
    public function updateDepartment(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $id,
            'head' => 'nullable|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->update([
            'name' => $request->name,
            'head' => $request->head,
        ]);

        return back()->with('success', 'Department updated successfully');
    }

    /**
     * Delete a department
     */
    public function destroyDepartment($id)
    {
        $department = Department::findOrFail($id);
        
        // Check if department has blocks
        if ($department->blocks()->count() > 0) {
            return back()->with('error', 'Cannot delete department with existing blocks');
        }

        $department->delete();
        return back()->with('success', 'Department deleted successfully');
    }

    /**
     * Store a new block
     */
    public function storeBlock(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
        ]);

        // Check if block name already exists in this department
        $exists = Block::where('department_id', $request->department_id)
                       ->where('name', $request->name)
                       ->exists();

        if ($exists) {
            return back()->with('error', 'Block name already exists in this department');
        }

        Block::create([
            'department_id' => $request->department_id,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Block added successfully');
    }

    /**
     * Update a block
     */
    public function updateBlock(Request $request, $id)
    {
        $block = Block::findOrFail($id);

        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
        ]);

        // Check if another block with same name exists in this department
        $exists = Block::where('department_id', $request->department_id)
                       ->where('name', $request->name)
                       ->where('id', '!=', $id)
                       ->exists();

        if ($exists) {
            return back()->with('error', 'Block name already exists in this department');
        }

        $block->update([
            'department_id' => $request->department_id,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Block updated successfully');
    }

    /**
     * Delete a block
     */
    public function destroyBlock($id)
    {
        $block = Block::findOrFail($id);
        
        $block->delete();
        return back()->with('success', 'Block deleted successfully');
    }

/**
 * Delete all blocks
 */
public function destroyAllBlocks(Request $request)
{
    try {
        // Log the request
        \Log::info('destroyAllBlocks called', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'session' => session()->all()
        ]);
        
        // First, check if any blocks are being used in classes
        $blocksInUse = Block::has('classes')->count();
        
        if ($blocksInUse > 0) {
            return back()->with('error', 'Cannot delete blocks because they are being used in existing classes. Please delete the classes first or reassign them.');
        }
        
        // If no blocks are in use, proceed with truncate
        Block::truncate();
        return back()->with('success', 'All blocks deleted successfully');
    } catch (\Exception $e) {
        \Log::error('Error deleting all blocks: ' . $e->getMessage());
        
        // Check if it's a foreign key constraint error
        if (str_contains($e->getMessage(), 'foreign key constraint')) {
            return back()->with('error', 'Cannot delete blocks because they are being used in existing classes. Please delete the classes first or reassign them.');
        }
        
        return back()->with('error', 'Failed to delete all blocks: ' . $e->getMessage());
    }
}

/**
 * Delete all departments
 */
public function destroyAllDepartments(Request $request)
{
    try {
        \Log::info('destroyAllDepartments called', [
            'method' => $request->method(),
            'url' => $request->fullUrl()
        ]);
        
        // Check if any department has blocks
        $departmentsWithBlocks = Department::has('blocks')->count();
        
        if ($departmentsWithBlocks > 0) {
            return back()->with('error', 'Cannot delete departments with existing blocks. Delete all blocks first.');
        }
        
        // Check if any departments are being used in classes
        $departmentsInUse = Department::has('classes')->count();
        
        if ($departmentsInUse > 0) {
            return back()->with('error', 'Cannot delete departments because they are being used in existing classes. Please delete the classes first or reassign them.');
        }

        Department::truncate();
        return back()->with('success', 'All departments deleted successfully');
    } catch (\Exception $e) {
        \Log::error('Error deleting all departments: ' . $e->getMessage());
        
        if (str_contains($e->getMessage(), 'foreign key constraint')) {
            return back()->with('error', 'Cannot delete departments because they are being used in existing classes. Please delete the classes first or reassign them.');
        }
        
        return back()->with('error', 'Failed to delete all departments: ' . $e->getMessage());
    }
}
}