@extends('layout')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h3 class="text-2xl font-semibold mb-6 text-gray-800">Edit Class</h3>

    <form action="{{ route('classes.update', $class->class_id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-medium mb-1">Block</label>
            <input type="text" name="block" value="{{ $class->block }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Section</label>
            <input type="text" name="section" value="{{ $class->section }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Subject</label>
            <input type="text" name="subject" value="{{ $class->subject }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                   required>
        </div>

        <div class="flex justify-between items-center mt-6">
            <button type="submit" 
                    class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Update
            </button>
            <a href="{{ route('classes.index') }}" 
               class="px-6 py-2 bg-gray-300 text-gray-800 font-semibold rounded-lg hover:bg-gray-400 transition">
               Cancel
            </a>
        </div>
    </form>
</div>
@endsection
