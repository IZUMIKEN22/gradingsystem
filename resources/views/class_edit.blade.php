@extends('layout')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h3 class="text-2xl font-semibold mb-6 text-gray-800">Edit Class</h3>

    <form action="{{ route('classes.update', $class->class_id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-medium mb-1">Academic Year</label>
            <select name="academic_year_id" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    required>
                @foreach($academicYears as $year)
                    <option value="{{ $year->id }}" {{ $class->academic_year_id == $year->id ? 'selected' : '' }}>
                        {{ $year->academic_year }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Semester</label>
            <select name="semester" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    required>
                <option value="1st Semester" {{ $class->semester == '1st Semester' ? 'selected' : '' }}>1st Semester</option>
                <option value="2nd Semester" {{ $class->semester == '2nd Semester' ? 'selected' : '' }}>2nd Semester</option>
                <option value="Summer" {{ $class->semester == 'Summer' ? 'selected' : '' }}>Summer</option>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Department</label>
            <select name="department_id" id="department" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    required>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" 
                            data-head="{{ $dept->head }}"
                            {{ $class->department_id == $dept->id ? 'selected' : '' }}>
                        {{ $dept->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Department Head</label>
            <input type="text" name="head_of_department" id="head_of_department" 
                   value="{{ $class->head_of_department }}" 
                   class="w-full px-4 py-2 border rounded-lg bg-gray-50 text-gray-700" 
                   readonly>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Block</label>
            <select name="block_id" id="block" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                    required>
                @foreach($blocks as $block)
                    <option value="{{ $block->id }}" {{ $class->block_id == $block->id ? 'selected' : '' }}>
                        {{ $block->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Section</label>
            <input type="text" name="section" value="{{ $class->section }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Subject Code</label>
            <input type="text" name="subject_code" value="{{ $class->subject_code }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Subject Description</label>
            <input type="text" name="subject_description" value="{{ $class->subject_description }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                   required>
        </div>

        <!-- CREDITS FIELD - NEW -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">
                Credits <span class="text-red-500">*</span>
            </label>
            <input type="number" name="credits" value="{{ $class->credits ?? 3.0 }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                   min="1" max="5" step="1" required>
            <p class="text-xs text-gray-500 mt-1">Credit units</p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Schedule Days</label>
            <input type="text" name="schedule_date" value="{{ $class->schedule_date }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                   required>
            <p class="text-xs text-gray-500 mt-1">e.g., Monday, Wednesday, Friday</p>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Schedule Time</label>
            <input type="text" name="schedule_time" value="{{ $class->schedule_time }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                   required>
            <p class="text-xs text-gray-500 mt-1">e.g., 9:00 AM - 10:30 AM</p>
        </div>

        <div class="flex justify-between items-center mt-6">
            <button type="submit" 
                    class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Update Class
            </button>
            <a href="{{ route('classes.index') }}" 
               class="px-6 py-2 bg-gray-300 text-gray-800 font-semibold rounded-lg hover:bg-gray-400 transition">
               Cancel
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const department = document.getElementById('department');
    const headInput = document.getElementById('head_of_department');
    const blockSelect = document.getElementById('block');

    if (department) {
        department.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const headName = selectedOption.getAttribute('data-head') || 'No head assigned';
            headInput.value = headName;

            const departmentId = this.value;

            // Fetch blocks via AJAX
            fetch(`/departments/${departmentId}/blocks`)
                .then(response => response.json())
                .then(data => {
                    // Clear current options except the first one
                    blockSelect.innerHTML = '<option value="" disabled>Select block</option>';
                    
                    data.forEach(block => {
                        const option = document.createElement('option');
                        option.value = block.id;
                        option.textContent = block.name;
                        blockSelect.appendChild(option);
                    });

                    // Try to select the current block if it exists in the new list
                    const currentBlockId = "{{ $class->block_id }}";
                    if (currentBlockId) {
                        blockSelect.value = currentBlockId;
                    }
                })
                .catch(error => {
                    console.error('Error fetching blocks:', error);
                    blockSelect.innerHTML = '<option value="" disabled>No blocks available</option>';
                });
        });

        // Trigger change on page load to load blocks for current department
        if (department.value) {
            department.dispatchEvent(new Event('change'));
        }
    }
});
</script>
@endsection