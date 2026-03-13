@extends('layout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Page Header -->
        <div class="mb-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Teacher Dashboard</h1>
                    <p class="mt-2 text-gray-600">Manage your academic years, classes, and subjects</p>
                </div>
                <div class="text-sm text-gray-500 bg-gray-50 px-4 py-2 rounded-lg">
                    <span class="font-medium" id="activeClassesCount">{{ count($classes) }}</span> active classes
                </div>
            </div>

            <!-- Divider -->
            <div class="mt-6 border-b border-gray-200"></div>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="mb-8 rounded-xl bg-green-50 border border-green-200 p-4 flex items-start">
                <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <div class="text-green-800">{{ session('success') }}</div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-8 rounded-xl bg-red-50 border border-red-200 p-4 flex items-start">
                <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                <div class="text-red-800">{{ session('error') }}</div>
            </div>
        @endif

        <!-- Quick Add Section -->
        <div class="grid lg:grid-cols-2 gap-8 mb-10">
            <!-- Add Academic Year Card -->
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-green-100 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">Add Academic Year</h2>
                </div>

                <form method="POST" action="{{ route('academic-years.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Academic Year Format
                            <span class="text-xs text-gray-500 ml-1">(e.g., 2025–2026)</span>
                        </label>
                        <div class="flex gap-3">
                            <input type="text" name="academic_year" placeholder="Enter academic year"
                                class="flex-1 rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                required>
                            <button type="submit"
                                class="bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-3 rounded-lg font-medium hover:from-green-700 hover:to-green-800 transition shadow-sm">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Current Academic Years (Selectable) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Academic Years</h3>
                    <span class="text-xs text-gray-500">{{ $academicYears->count() }} total</span>
                </div>
                
                <!-- Academic Year Filter -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Filter by Academic Year
                    </label>
                    <select id="academicYearFilter" 
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        <option value="all">All Academic Years</option>
                        @foreach($academicYears as $year)
                            <option value="{{ $year->id }}">{{ $year->academic_year }}</option>
                        @endforeach
                    </select>
                </div>

                @if($academicYears->isEmpty())
                    <p class="text-gray-500 text-center py-4">No academic years added yet</p>
                @else
                    <div class="space-y-2 max-h-32 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($academicYears as $year)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition academic-year-item" 
                                 data-year-id="{{ $year->id }}">
                                <span class="font-medium text-gray-700">{{ $year->academic_year }}</span>
                                <span class="text-xs px-2 py-1 bg-gray-200 text-gray-600 rounded class-count" data-year-id="{{ $year->id }}">
                                    {{ $year->classes_count ?? 0 }} {{ ($year->classes_count ?? 0) == 1 ? 'Class' : 'Classes' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Add New Class Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-10">
            <!-- Header with Add Button -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-2 bg-indigo-100 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Class Management</h2>
                        <p class="text-gray-600 mt-1">Create and manage your classes</p>
                    </div>
                </div>
                
                <!-- Add Class Button -->
                <button id="toggleClassForm"
                    class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-indigo-800 transition shadow-md flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Class
                </button>
            </div>

            <!-- Class Form (Initially Hidden) -->
            <div id="classForm" class="hidden transition-all duration-300 ease-in-out">
                <form method="POST" action="/classes" class="space-y-8 mt-6">
                    @csrf

                    <!-- Academic Info Section -->
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </span>
                            Academic Information
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Academic Year <span class="text-red-500">*</span>
                                </label>
                                <select name="academic_year_id"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition hover:border-indigo-300"
                                    required>
                                    <option value="" disabled selected>Select an academic year</option>
                                    @foreach($academicYears as $year)
                                        <option value="{{ $year->id }}">{{ $year->academic_year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Semester <span class="text-red-500">*</span>
                                </label>
                                <select name="semester"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition hover:border-indigo-300"
                                    required>
                                    <option value="" disabled selected>Select semester</option>
                                    <option value="1st Semester">1st Semester</option>
                                    <option value="2nd Semester">2nd Semester</option>
                                    <option value="Summer">Summer</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Class Details Section -->
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </span>
                            Class Details
                        </h3>
                        <div class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Department <span class="text-red-500">*</span>
                                    </label>
                                    <select name="department_id" id="department"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition hover:border-indigo-300"
                                        required>
                                        <option value="" disabled selected>Select department</option>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}" data-head="{{ $dept->head }}">
                                                {{ $dept->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Department Head
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="head_of_department" id="head_of_department"
                                            class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-700 font-medium"
                                            readonly placeholder="Select department first">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Block <span class="text-red-500">*</span>
                                    </label>
                                    <select name="block_id" id="block"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition hover:border-indigo-300"
                                        required>
                                        <option value="" disabled selected>Select block</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Section <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="section" placeholder="e.g., A, B, C"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition hover:border-indigo-300"
                                        required>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Subject Code <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="subject_code" placeholder="e.g., CS101, MATH201"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition hover:border-indigo-300"
                                        required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Subject Description <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="subject_description" placeholder="Enter full subject description"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition hover:border-indigo-300"
                                        required>
                                </div>
                            </div>

                            <!-- Credits Field (New) -->
                            <div class="grid md:grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Credits <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="credits" placeholder="e.g., 3"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition hover:border-indigo-300"
                                        min="0.5" max="12" step="0.5" required>
                                    <p class="text-xs text-gray-500 mt-1">Credit units (0.5 increments)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Schedule Section -->
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 border border-gray-100 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            Schedule
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Days <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="schedule_date" placeholder="e.g., Monday, Wednesday, Friday"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition hover:border-indigo-300"
                                    required>
                                <p class="text-xs text-gray-500 mt-1">Separate days with commas</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Time <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="schedule_time" placeholder="e.g., 9:00 AM - 10:30 AM"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition hover:border-indigo-300"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-4">
                        <button type="button" id="cancelForm"
                            class="px-6 py-3 rounded-lg font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 transition flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-8 py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-indigo-800 transition shadow-md flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create Class
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Classes Section -->
<div>
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Your Classes</h2>
            <p class="text-gray-600 mt-1" id="filterDescription">Showing all classes</p>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-sm font-medium text-gray-500" id="filteredClassesCount">
                {{ count($classes) }} total
            </span>
            @if($academicYears->isNotEmpty())
                <button id="clearFilter" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium hidden">
                    Clear Filter
                </button>
            @endif
        </div>
    </div>

    <div id="classesContainer">
        @if($classes->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="p-3 bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Classes Yet</h3>
                    <p class="text-gray-600 mb-6">Get started by creating your first class above</p>
                </div>
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="classesGrid">
                @foreach($classes as $class)
                    <div class="class-card group cursor-pointer bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-lg hover:border-indigo-300 transition-all duration-300"
                         data-year-id="{{ $class->academic_year_id }}"
                         data-year-name="{{ $class->academicYear->academic_year ?? 'Unknown' }}"
                         onclick="window.location='{{ route('class.students', ['class_id' => $class->class_id]) }}'">

                        <!-- Card Header -->
                        <div class="mb-4">
                            <div class="flex justify-between items-start mb-2">
                                <span
                                    class="inline-block px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-semibold rounded-full">
                                    {{ $class->semester }}
                                </span>
                                <span class="text-xs text-gray-500 font-medium academic-year-badge">
                                    {{ $class->academicYear->academic_year ?? 'N/A' }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-700 transition">
                                {{ $class->subject_code }}
                            </h3>
                            <p class="text-gray-600 text-sm mt-1 line-clamp-2">
                                {{ $class->subject_description }}
                            </p>
                            
                            <!-- Credits Badge (New) -->
                            <div class="mt-3">
                                <div class="inline-flex items-center px-3 py-1 rounded-full bg-amber-100">
                                    <svg class="w-4 h-4 text-amber-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="font-medium text-amber-900">{{ $class->credits ?? '3' }} Credits</span>
                                </div>
                            </div>
                        </div>

                        <!-- Class Info -->
                        <div class="space-y-3 mb-6">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Department</p>
                                    <p class="font-medium text-gray-900">{{ $class->department->name ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Block</p>
                                    <p class="font-medium text-gray-900">{{ $class->block->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Section</p>
                                <div class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100">
                                    <span class="font-medium text-gray-900">{{ $class->section }}</span>
                                </div>
                            </div>

                            <div class="pt-3 border-t border-gray-100">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Schedule</p>
                                <div class="flex flex-col space-y-2">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="font-medium text-gray-900">{{ $class->schedule_date }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-gray-700">{{ $class->schedule_time }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('classes.edit', $class->class_id) }}" onclick="event.stopPropagation()"
                                class="flex-1 text-center bg-indigo-50 text-indigo-700 py-2.5 rounded-lg font-medium hover:bg-indigo-100 transition flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('classes.destroy', $class->class_id) }}" method="POST"
                                onclick="event.stopPropagation()" class="flex-none">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this class?')"
                                    class="bg-red-50 text-red-700 px-4 py-2.5 rounded-lg font-medium hover:bg-red-100 transition flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
    </div>

    <!-- Custom Scrollbar Styles -->
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Animation for filter */
        .filter-fade-enter {
            opacity: 0;
            transform: scale(0.9);
        }
        .filter-fade-enter-active {
            opacity: 1;
            transform: scale(1);
            transition: opacity 300ms, transform 300ms;
        }
        .filter-fade-exit {
            opacity: 1;
            transform: scale(1);
        }
        .filter-fade-exit-active {
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 300ms, transform 300ms;
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Department and Block selection logic
        const department = document.getElementById('department');
        const headInput = document.getElementById('head_of_department');
        const blockSelect = document.getElementById('block');

        if (department) {
            department.addEventListener('change', () => {
                const selectedOption = department.options[department.selectedIndex];
                const head = selectedOption.getAttribute('data-head') || '';
                headInput.value = head;

                const departmentId = department.value;

                // Clear previous blocks
                blockSelect.innerHTML = '<option value="" disabled selected>Loading blocks...</option>';

                // Fetch blocks via AJAX
                fetch(`/departments/${departmentId}/blocks`)
                    .then(response => response.json())
                    .then(data => {
                        blockSelect.innerHTML = '<option value="" disabled selected>Select block</option>';
                        data.forEach(block => {
                            const option = document.createElement('option');
                            option.value = block.id;
                            option.textContent = block.name;
                            blockSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching blocks:', error);
                        blockSelect.innerHTML = '<option value="" disabled selected>No blocks available</option>';
                    });
            });

            // Trigger change event if department is pre-selected
            if (department.value) {
                department.dispatchEvent(new Event('change'));
            }
        }

        // Toggle form visibility
        const toggleButton = document.getElementById('toggleClassForm');
        const classForm = document.getElementById('classForm');
        const cancelButton = document.getElementById('cancelForm');

        function showForm() {
            classForm.classList.remove('hidden');
            toggleButton.innerHTML = `
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Close Form
            `;
            toggleButton.classList.remove('from-indigo-600', 'to-indigo-700', 'hover:from-indigo-700', 'hover:to-indigo-800');
            toggleButton.classList.add('from-red-500', 'to-red-600', 'hover:from-red-600', 'hover:to-red-700');
        }

        function hideForm() {
            classForm.classList.add('hidden');
            toggleButton.innerHTML = `
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Class
            `;
            toggleButton.classList.remove('from-red-500', 'to-red-600', 'hover:from-red-600', 'hover:to-red-700');
            toggleButton.classList.add('from-indigo-600', 'to-indigo-700', 'hover:from-indigo-700', 'hover:to-indigo-800');
        }

        if (toggleButton) {
            toggleButton.addEventListener('click', () => {
                if (classForm.classList.contains('hidden')) {
                    showForm();
                } else {
                    hideForm();
                }
            });
        }

        if (cancelButton) {
            cancelButton.addEventListener('click', hideForm);
        }

        // ==================== ACADEMIC YEAR FILTER ====================
        const academicYearFilter = document.getElementById('academicYearFilter');
        const clearFilterBtn = document.getElementById('clearFilter');
        const filterDescription = document.getElementById('filterDescription');
        const filteredClassesCount = document.getElementById('filteredClassesCount');
        const activeClassesCount = document.getElementById('activeClassesCount');
        const classCards = document.querySelectorAll('.class-card');
        const academicYearItems = document.querySelectorAll('.academic-year-item');

        // Function to update class counts in the academic year list
        function updateAcademicYearCounts() {
            const yearCounts = {};
            
            // Count classes per academic year
            classCards.forEach(card => {
                const yearId = card.dataset.yearId;
                if (yearId) {
                    yearCounts[yearId] = (yearCounts[yearId] || 0) + 1;
                }
            });

            // Update the count badges
            document.querySelectorAll('.class-count').forEach(badge => {
                const yearId = badge.dataset.yearId;
                const count = yearCounts[yearId] || 0;
                badge.textContent = `${count} ${count === 1 ? 'Class' : 'Classes'}`;
            });
        }

        // Function to filter classes by academic year
        function filterClassesByYear(yearId) {
            let visibleCount = 0;
            const totalClasses = classCards.length;

            classCards.forEach(card => {
                if (yearId === 'all' || card.dataset.yearId === yearId) {
                    card.classList.remove('hidden');
                    // Add animation class
                    card.style.animation = 'none';
                    card.offsetHeight; // Trigger reflow
                    card.style.animation = 'fadeIn 0.3s ease-out';
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            // Update UI
            if (yearId === 'all') {
                filterDescription.textContent = 'Showing all classes';
                filteredClassesCount.textContent = `${totalClasses} total`;
                activeClassesCount.textContent = totalClasses;
                if (clearFilterBtn) clearFilterBtn.classList.add('hidden');
                
                // Remove active state from academic year items
                academicYearItems.forEach(item => {
                    item.classList.remove('bg-indigo-50', 'border-l-4', 'border-indigo-500');
                });
            } else {
                // Get the selected year name from the dropdown
                const selectedOption = academicYearFilter ? 
                    academicYearFilter.options[academicYearFilter.selectedIndex] : null;
                const selectedYearName = selectedOption ? selectedOption.text : 'selected year';
                
                filterDescription.textContent = `Showing classes for ${selectedYearName}`;
                filteredClassesCount.textContent = `${visibleCount} of ${totalClasses} classes`;
                activeClassesCount.textContent = visibleCount;
                if (clearFilterBtn) clearFilterBtn.classList.remove('hidden');
                
                // Highlight the selected academic year in the list
                academicYearItems.forEach(item => {
                    if (item.dataset.yearId === yearId) {
                        item.classList.add('bg-indigo-50', 'border-l-4', 'border-indigo-500');
                    } else {
                        item.classList.remove('bg-indigo-50', 'border-l-4', 'border-indigo-500');
                    }
                });
            }

            // Show "no results" message if needed
            const classesGrid = document.getElementById('classesGrid');
            const existingNoResults = document.getElementById('noClassesMessage');

            if (visibleCount === 0 && totalClasses > 0) {
                if (!existingNoResults && classesGrid) {
                    const noResultsDiv = document.createElement('div');
                    noResultsDiv.id = 'noClassesMessage';
                    noResultsDiv.className = 'col-span-full bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center';
                    
                    // Get the selected year name for the message
                    const selectedOption = academicYearFilter ? 
                        academicYearFilter.options[academicYearFilter.selectedIndex] : null;
                    const selectedYearName = selectedOption ? selectedOption.text : 'this academic year';
                    
                    noResultsDiv.innerHTML = `
                        <div class="max-w-md mx-auto">
                            <div class="p-3 bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Classes Found</h3>
                            <p class="text-gray-600">No classes available for ${selectedYearName}.</p>
                            <button onclick="document.getElementById('academicYearFilter').value='all'; filterClassesByYear('all');" 
                                class="mt-4 text-indigo-600 hover:text-indigo-800 font-medium">
                                Show all classes
                            </button>
                        </div>
                    `;
                    
                    // Insert after classesGrid
                    classesGrid.parentNode.insertBefore(noResultsDiv, classesGrid.nextSibling);
                    
                    // Hide the grid temporarily
                    classesGrid.style.display = 'none';
                }
            } else {
                if (existingNoResults) {
                    existingNoResults.remove();
                }
                if (classesGrid) {
                    classesGrid.style.display = 'grid';
                }
            }
        }

        // Event listener for academic year filter dropdown
        if (academicYearFilter) {
            academicYearFilter.addEventListener('change', function() {
                const selectedYearId = this.value;
                filterClassesByYear(selectedYearId);
            });
        }

        // Make academic year items clickable for filtering
        academicYearItems.forEach(item => {
            item.addEventListener('click', function() {
                const yearId = this.dataset.yearId;
                
                // Update dropdown
                if (academicYearFilter) {
                    academicYearFilter.value = yearId;
                }
                
                // Filter classes
                filterClassesByYear(yearId);
            });
            
            // Add cursor pointer to indicate clickability
            item.style.cursor = 'pointer';
        });

        // Clear filter button
        if (clearFilterBtn) {
            clearFilterBtn.addEventListener('click', function() {
                if (academicYearFilter) {
                    academicYearFilter.value = 'all';
                }
                filterClassesByYear('all');
            });
        }

        // Initialize counts and ensure all classes are visible initially
        updateAcademicYearCounts();
        
        // Make sure all classes are visible on page load
        filterClassesByYear('all');

        // Add fadeIn animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            .class-card.hidden {
                display: none;
            }
            .class-card {
                transition: all 0.3s ease;
            }
        `;
        document.head.appendChild(style);
    });
</script>

    <!-- Department head auto-fill (your existing code) - Keeping for backward compatibility -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deptSelect = document.getElementById('department');
            if (deptSelect) {
                deptSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const headName = selectedOption.getAttribute('data-head') || 'No head assigned';
                    document.getElementById('head_of_department').value = headName;
                });
            }
        });
    </script>
@endsection