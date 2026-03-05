@extends('layout')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 px-4 py-8 flex flex-col items-center">

        <!-- Header Section -->
        <div class="w-full max-w-6xl mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">📚 Class Management</h1>
                    <p class="text-gray-600">Manage students, assessments, and grading components for your class</p>
                </div>
                <div class="flex items-center gap-3 bg-white px-4 py-3 rounded-xl shadow-sm border border-gray-200">
                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-gray-700">Class ID: <span
                            class="font-bold text-blue-600">{{ $classId }}</span></span>
                </div>
            </div>
        </div>

        <!-- Quick Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 w-full max-w-6xl mb-8">
            <div
                class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-blue-100 rounded-xl">
                        <span class="text-2xl">👨‍🎓</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Students</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalStudents ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-purple-100 rounded-xl">
                        <span class="text-2xl">📋</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Assessments</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $assessments->count() }}</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-green-100 rounded-xl">
                        <span class="text-2xl">⚖️</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Grading Components</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $criteriaList->count() }}</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-orange-100 rounded-xl">
                        <span class="text-2xl">📊</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Percentage</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $criteriaList->sum('percentage') }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Cards Section -->
        <div class="w-full max-w-6xl mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Upload Excel Card -->
                <div
                    class="bg-gradient-to-br from-green-50 to-emerald-100 p-6 rounded-2xl border border-green-200 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-white rounded-xl shadow-sm">
                            <span class="text-2xl">📤</span>
                        </div>
                        <span class="text-xs font-medium px-3 py-1 bg-green-100 text-green-800 rounded-full">Import</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Upload Students</h3>
                    <p class="text-sm text-gray-600 mb-4">Import student list from Excel file</p>
                    <button id="uploadBtn"
                        class="w-full py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-sm hover:shadow flex items-center justify-center gap-2">
                        <span>Upload Excel</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Add Grading Component Card -->
                <div
                    class="bg-gradient-to-br from-purple-50 to-violet-100 p-6 rounded-2xl border border-purple-200 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-white rounded-xl shadow-sm">
                            <span class="text-2xl">⚖️</span>
                        </div>
                        <span class="text-xs font-medium px-3 py-1 bg-purple-100 text-purple-800 rounded-full">Setup</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Grading Components</h3>
                    <p class="text-sm text-gray-600 mb-4">Define assessment categories and weights</p>
                    <button id="openCriteriaModal"
                        class="w-full py-3 bg-gradient-to-r from-purple-500 to-violet-600 text-white font-medium rounded-xl hover:from-purple-600 hover:to-violet-700 transition-all duration-300 shadow-sm hover:shadow flex items-center justify-center gap-2">
                        <span>Add Component</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </button>
                </div>

                <!-- Add Assessment Card -->
                <div
                    class="bg-gradient-to-br from-indigo-50 to-blue-100 p-6 rounded-2xl border border-indigo-200 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-white rounded-xl shadow-sm">
                            <span class="text-2xl">📝</span>
                        </div>
                        <span
                            class="text-xs font-medium px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full">Assessment</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Create Assessment</h3>
                    <p class="text-sm text-gray-600 mb-4">Add quizzes, exams, or activities</p>
                    <button id="openAssessmentModal"
                        class="w-full py-3 bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-medium rounded-xl hover:from-indigo-600 hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow flex items-center justify-center gap-2">
                        <span>Add Assessment</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Secondary Actions -->
        <div class="w-full max-w-6xl mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- View Grading Sheet Card -->
                <div
                    class="relative bg-gradient-to-br from-orange-50 to-red-100 p-5 rounded-2xl border border-orange-200 shadow-sm hover-lift transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white rounded-lg shadow-sm">
                                <span class="text-xl">📊</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">View Grading Sheet</h3>
                                <p class="text-sm text-gray-600 mt-1">Choose which grading sheet to view</p>
                            </div>
                        </div>

                        <!-- Dropdown Button -->
                        <div class="relative">
                            <button type="button" onclick="toggleGradingSheetDropdown()"
                                class="px-5 py-2.5 bg-gradient-to-r from-orange-500 to-red-600 text-white text-sm font-medium rounded-xl hover:from-orange-600 hover:to-red-700 transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-2 group">
                                <span>Open Sheet</span>
                                <svg id="dropdownArrow" class="w-4 h-4 transition-transform duration-300" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Dropdown Menu -->
                    <div id="gradingSheetDropdown"
                        class="hidden absolute right-0 top-full mt-2 w-56 bg-white rounded-xl border border-orange-100 shadow-2xl z-50 overflow-hidden animate-fadeIn"
                        style="box-shadow: 0 10px 40px rgba(249, 115, 22, 0.15);">
                        <!-- Header -->
                        <div class="px-4 py-3 bg-gradient-to-r from-orange-50 to-red-50 border-b border-orange-100">
                            <p class="text-sm font-semibold text-gray-800">Select Sheet Type</p>
                            <p class="text-xs text-gray-500 mt-0.5">Choose which period to view</p>
                        </div>

                        <!-- Options -->
                        <div class="py-1">
                            <!-- Full Sheet -->
                            <a href="{{ route('grades.download.full', ['class_id' => $classId]) }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-orange-50 transition-colors duration-200 group">
                                <div
                                    class="w-8 h-8 rounded-lg bg-gradient-to-r from-orange-100 to-red-100 flex items-center justify-center">
                                    <span class="text-orange-600">📋</span>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Full Grading Sheet</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Complete semester grades</p>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-orange-500 transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <!-- Midterm Sheet -->
                            <a href="{{ route('grades.download.midterm', ['class_id' => $classId]) }}?period=midterm"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-orange-50 transition-colors duration-200 group border-t border-gray-100">
                                <div
                                    class="w-8 h-8 rounded-lg bg-gradient-to-r from-yellow-100 to-amber-100 flex items-center justify-center">
                                    <span class="text-amber-600">📅</span>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Midterm Sheet</p>
                                    <p class="text-xs text-gray-500 mt-0.5">First half period grades</p>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-amber-500 transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <!-- Final Sheet -->
                            <a href="{{ route('grades.download.final', ['class_id' => $classId]) }}?period=final"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-orange-50 transition-colors duration-200 group border-t border-gray-100">
                                <div
                                    class="w-8 h-8 rounded-lg bg-gradient-to-r from-red-100 to-rose-100 flex items-center justify-center">
                                    <span class="text-red-600">🎯</span>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Final Sheet</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Second half period grades</p>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-red-500 transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="px-4 py-2 bg-gray-50 border-t border-gray-100">
                            <p class="text-xs text-gray-500 text-center">Click any option to view</p>
                        </div>
                    </div>
                </div>
                <!-- Add Scores Card -->
                <div
                    class="bg-gradient-to-br from-yellow-50 to-amber-100 p-5 rounded-2xl border border-yellow-200 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white rounded-lg">
                                <span class="text-xl">✏️</span>
                            </div>
                            <h3 class="font-semibold text-gray-800">Enter Student Scores</h3>
                        </div>
                        <button id="openScoresModal"
                            class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-amber-600 text-white text-sm font-medium rounded-xl hover:from-yellow-600 hover:to-amber-700 transition-all duration-300 shadow-sm hover:shadow">
                            Add Scores
                        </button>
                    </div>
                    <p class="text-sm text-gray-600">Enter or update student scores for assessments</p>
                </div>
            </div>
        </div>

        <!-- Alerts Container -->
        <div class="w-full max-w-6xl mb-6">
            <div id="successAlert"
                class="hidden bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-lg mb-3 transition-all duration-500 transform -translate-y-2 opacity-0">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span id="successMessage"></span>
                </div>
            </div>

            <div id="errorAlert"
                class="hidden bg-gradient-to-r from-red-500 to-rose-600 text-white px-6 py-4 rounded-xl shadow-lg mb-3 transition-all duration-500 transform -translate-y-2 opacity-0">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span id="errorMessage"></span>
                </div>
            </div>
        </div>

        <!-- Students Table Section with Search -->
        <div class="w-full max-w-6xl">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <!-- Table Header with Search -->
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">👨‍🎓 Students List</h3>
                            <p class="text-sm text-gray-600">View and manage student records and scores</p>
                        </div>

                        <!-- Search Input -->
                        <div class="relative w-full sm:w-72">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="studentSearch" placeholder="Search by student name..."
                                class="pl-10 pr-4 py-2.5 w-full border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm hover:shadow-md"
                                onkeyup="filterStudents()">
                            <!-- Clear search button (hidden by default) -->
                            <button id="clearSearch" onclick="clearSearch()"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 hidden">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Search Stats (hidden by default) -->
                    <div id="searchStats" class="mt-2 text-sm text-gray-500 hidden">
                        Found <span id="visibleCount">0</span> student(s)
                    </div>
                </div>

                <!-- Table Container -->
                <div class="overflow-x-auto">
                    <table id="studentTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr id="groupHeader">
                                <th rowspan="3"
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gray-100">
                                    <div class="flex items-center gap-2">
                                        <span>#</span>
                                        <span>Student Number</span>
                                    </div>
                                </th>
                                <th rowspan="3"
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gray-100">
                                    <div class="flex items-center gap-2">
                                        <span>👤</span>
                                        <span>Student Name</span>
                                    </div>
                                </th>
                                <!-- Dynamic GROUP headers go here -->
                            </tr>

                            <!-- Midterm / Final row -->
                            <tr id="typeHeader"></tr>

                            <!-- Assessment header -->
                            <tr id="assessmentHeader">
                                <!-- Dynamic ASSESSMENT headers go here -->
                            </tr>

                            <tr id="highestScoreHeader"></tr>
                        </thead>
                        <tbody id="studentTableBody" class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td colspan="100" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 3.75a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75A2.25 2.25 0 013 4.5h15a2.25 2.25 0 012.25 2.25v12z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 font-medium">Loading students...</p>
                                            <p class="text-sm text-gray-400 mt-1">Please wait while we fetch student data
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer with Search Results Info -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-3 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span id="studentCountDisplay">Total students will appear here</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="flex items-center gap-1">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                Passed
                            </span>
                            <span class="flex items-center gap-1">
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                Failed
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ==================== MODALS ==================== -->
    <!-- Scores Modal -->
    <div id="scoresModal"
        class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4 transition-all duration-300">
        <div
            class="bg-white rounded-3xl shadow-2xl w-full max-w-6xl max-h-[90vh] overflow-hidden animate-modalIn scale-100">
            <!-- Modern Glass Morphism Header -->
            <div class="relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600">
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 60" height="60"
                        viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" %3E%3Cg fill="none" fill-rule="evenodd"
                        %3E%3Cg fill="%23ffffff" fill-opacity="0.1" %3E%3Cpath
                        d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                        /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
                </div>

                <!-- Header Content -->
                <div class="relative px-8 py-6 backdrop-blur-sm bg-white/10">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-white/20 backdrop-blur-md rounded-2xl shadow-xl border border-white/30">
                                <span class="text-3xl filter drop-shadow-lg">✨</span>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white drop-shadow-md">Enter Student Scores</h2>
                                <p class="text-white/80 text-sm mt-1 flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-white/60 rounded-full"></span>
                                    Add or update scores for selected assessment
                                </p>
                            </div>
                        </div>
                        <button id="closeScoresModal"
                            class="p-2 hover:bg-white/20 rounded-xl transition-all duration-300 group relative">
                            <div
                                class="absolute inset-0 bg-white/20 rounded-xl scale-0 group-hover:scale-100 transition-transform duration-300">
                            </div>
                            <svg class="w-6 h-6 text-white relative z-10" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Content with improved spacing and interactive elements -->
            <div class="p-8 bg-gradient-to-br from-slate-50 to-white overflow-y-auto"
                style="max-height: calc(90vh - 120px);">
                <form id="scoresForm" class="space-y-8">
                    @csrf
                    <input type="hidden" name="class_id" value="{{ $classId }}">

                    <!-- Assessment Selection Card with Live Search -->
                    <div
                        class="bg-white rounded-2xl shadow-lg border border-slate-200/80 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-slate-200">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-white rounded-xl shadow-sm">
                                    <span class="text-xl">📋</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-800">Assessment Selection</h3>
                                    <p class="text-xs text-slate-500 mt-0.5">Choose the assessment to manage scores</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">


                            <div class="relative mt-3">
                                <select id="scoreAssessmentSelect"
                                    class="w-full px-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-white text-slate-800 appearance-none cursor-pointer hover:border-indigo-300 pr-12">
                                    <option value="" class="text-slate-400">-- Choose an assessment --</option>
                                    @foreach($assessments as $a)
                                        <option value="{{ $a->id }}" data-highest="{{ $a->highest_score }}"
                                            data-category="{{ $a->gradingCriteria->name ?? 'No Category' }}" class="py-2">
                                            {{ $a->title }} • {{ $a->gradingCriteria->name ?? 'No Category' }} • Max:
                                            {{ $a->highest_score }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Enhanced Assessment Info Card -->
                            <div id="assessmentInfo"
                                class="mt-4 p-4 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl border border-indigo-200 hidden transform transition-all duration-300 scale-100 opacity-100">
                                <div class="flex items-center gap-4">
                                    <div class="p-3 bg-white rounded-xl shadow-sm">
                                        <span class="text-indigo-600 text-xl">📊</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-indigo-900">Assessment Details</p>
                                            <span
                                                class="px-3 py-1 bg-indigo-200 rounded-full text-xs font-semibold text-indigo-800">Active</span>
                                        </div>
                                        <div class="grid grid-cols-2 gap-4 mt-3">
                                            <div>
                                                <p class="text-xs text-indigo-600">Maximum Score</p>
                                                <p class="text-lg font-bold text-indigo-900"><span
                                                        id="maxScoreDisplay">100</span> <span
                                                        class="text-sm font-normal text-indigo-600">points</span></p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-indigo-600">Category</p>
                                                <p class="text-sm font-semibold text-indigo-900" id="assessmentCategory">
                                                    General</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Scores Table Section with Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-200/80 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-slate-50 to-white border-b border-slate-200">
                            <div class="flex items-center justify-between flex-wrap gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-indigo-100 rounded-xl">
                                        <span class="text-indigo-600 text-xl">📊</span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-slate-800">Student Scores</h3>
                                        <p class="text-xs text-slate-500 mt-0.5">Manage individual student scores</p>
                                    </div>
                                </div>

                                <!-- Quick Actions -->
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-xl">
                                        <span class="text-sm text-slate-600">Range:</span>
                                        <span
                                            class="px-3 py-1 bg-white rounded-lg text-sm font-medium text-indigo-600 shadow-sm">0
                                            - <span id="maxScoreDisplay2">100</span></span>
                                    </div>

                                    <!-- Bulk Actions Dropdown -->
                                    <div class="relative" id="bulkActionsDropdown">
                                        <!-- Dropdown Menu -->
                                        <div class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-slate-200 hidden z-20"
                                            id="bulkActionsMenu">
                                            <div class="py-2">
                                                <button type="button"
                                                    class="w-full px-4 py-3 text-left hover:bg-indigo-50 transition-colors duration-200 flex items-center gap-3 text-sm text-slate-700">
                                                    <span class="text-lg">📝</span>
                                                    Set all to 0
                                                </button>
                                                <button type="button"
                                                    class="w-full px-4 py-3 text-left hover:bg-indigo-50 transition-colors duration-200 flex items-center gap-3 text-sm text-slate-700">
                                                    <span class="text-lg">✅</span>
                                                    Set to maximum
                                                </button>
                                                <button type="button"
                                                    class="w-full px-4 py-3 text-left hover:bg-indigo-50 transition-colors duration-200 flex items-center gap-3 text-sm text-slate-700">
                                                    <span class="text-lg">📋</span>
                                                    Copy from previous
                                                </button>
                                                <div class="border-t border-slate-100 my-2"></div>
                                                <button type="button"
                                                    class="w-full px-4 py-3 text-left hover:bg-red-50 transition-colors duration-200 flex items-center gap-3 text-sm text-red-600">
                                                    <span class="text-lg">🗑️</span>
                                                    Clear all scores
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table with improved UX -->
                        <div class="overflow-x-auto" style="max-height: 400px;">
                            <table class="min-w-full divide-y divide-slate-200">
                                <thead class="bg-slate-100 sticky top-0 z-10">
                                    <tr>

                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                            <div class="flex items-center gap-2">
                                                <span class="text-base">🆔</span>
                                                Student Number
                                            </div>
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                            <div class="flex items-center gap-2">
                                                <span class="text-base">👤</span>
                                                Student Name
                                            </div>
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider w-48">
                                            <div class="flex items-center gap-2">
                                                <span class="text-base">🎯</span>
                                                Score
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="scoresTableBody" class="bg-white divide-y divide-slate-200">
                                    <tr id="noStudentsMessage">
                                        <td colspan="4" class="px-6 py-20 text-center">
                                            <div class="flex flex-col items-center justify-center gap-4">
                                                <div
                                                    class="w-24 h-24 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl flex items-center justify-center shadow-inner">
                                                    <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13.5 3.75a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75A2.25 2.25 0 013 4.5h15a2.25 2.25 0 012.25 2.25v12z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-slate-600 font-medium text-lg">Ready to get started?</p>
                                                    <p class="text-sm text-slate-400 mt-2 max-w-sm">Select an assessment
                                                        from the dropdown above to view and manage student scores</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal Actions with improved feedback -->
                    <div class="flex justify-between items-center pt-6 border-t border-slate-200">
                        <div class="flex items-center gap-2 text-sm text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Changes are saved automatically</span>
                        </div>

                        <div class="flex gap-3">
                            <button type="button" id="closeScoresModal2"
                                class="px-6 py-3 bg-white text-slate-700 font-medium rounded-xl hover:bg-slate-100 transition-all duration-300 border-2 border-slate-200 flex items-center gap-2 group">
                                <svg class="w-5 h-5 text-slate-500 group-hover:text-slate-700 transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center gap-2 transform hover:scale-105 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Scores
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Toast Notification -->
    <div id="successToast"
        class="fixed bottom-4 right-4 bg-white rounded-xl shadow-2xl border-l-4 border-green-500 p-4 transform transition-all duration-500 translate-y-20 opacity-0 z-50">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-green-100 rounded-lg">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                <p class="font-medium text-slate-800">Success!</p>
                <p class="text-sm text-slate-500">Scores have been saved successfully</p>
            </div>
        </div>
    </div>

    <!-- Enhanced Styles -->
    <style>
        @keyframes modalIn {
            0% {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }

            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-modalIn {
            animation: modalIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Custom scrollbar */
        .overflow-x-auto::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
            border: 2px solid #f1f5f9;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Input focus effects */
        input:focus,
        select:focus {
            outline: none;
        }

        /* Score input styling */
        .score-input {
            transition: all 0.2s ease;
        }

        .score-input:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .score-input.valid {
            border-color: #10b981;
            background-color: #f0fdf4;
        }

        .score-input.invalid {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        /* Table row hover effect */
        tbody tr {
            transition: background-color 0.2s ease;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Checkbox styling */
        input[type="checkbox"] {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        input[type="checkbox"]:checked {
            background-color: #446ae6;
            border-color: #436ad5;
        }

        /* Loading animation */
        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .loading-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Interactive card hover */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Progress bar animation */
        .progress-bar {
            transition: width 0.3s ease;
        }

        /* Search highlight animation */
        @keyframes highlightFade {
            0% {
                background-color: rgba(59, 130, 246, 0.2);
            }

            100% {
                background-color: transparent;
            }
        }

        .search-highlight {
            animation: highlightFade 1.5s ease-out;
        }

        .no-results-message {
            background: linear-gradient(to right, #f9fafb, #ffffff);
            border: 2px dashed #e5e7eb;
        }

        /* Search input animation */
        #studentSearch:focus {
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.1), 0 2px 4px -1px rgba(59, 130, 246, 0.06);
        }

        /* Smooth transitions for table rows */
        #studentTableBody tr {
            transition: all 0.2s ease-in-out;
        }

        #studentTableBody tr.hidden {
            display: none;
        }
    </style>

    <!-- Add Assessment Modal -->
    <div id="assessmentModal"
        class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden animate-modalIn">
            <!-- Modal Header -->
            <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-blue-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-white rounded-xl shadow-sm">
                            <span class="text-2xl">📝</span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Create New Assessment</h2>
                            <p class="text-gray-600">Add quizzes, exams, or activities for grading</p>
                        </div>
                    </div>
                    <button id="closeAssessmentModalX" class="p-2 hover:bg-white/50 rounded-xl transition-colors">
                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-8 overflow-y-auto max-h-[calc(90vh-140px)]">
                <form id="assessmentForm" class="space-y-6">
                    @csrf
                    <input type="hidden" name="class_id" value="{{ $classId }}">

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Assessment Title -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <span class="flex items-center gap-2">
                                    <span>📋</span>
                                    <span>Assessment Title</span>
                                </span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text" name="title"
                                    class="pl-10 w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                    placeholder="e.g., Quiz 1, Midterm Exam, Final Project" required>
                            </div>
                        </div>

                        <!-- Grading Component -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <span class="flex items-center gap-2">
                                    <span>⚖️</span>
                                    <span>Grading Component</span>
                                </span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                </div>
                                <select name="grading_criteria_id"
                                    class="pl-10 w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                    required>
                                    <option value="" class="text-gray-400">Select a component</option>
                                    @foreach($criteriaList as $c)
                                        <option value="{{ $c->id }}">
                                            {{ $c->component_name }} ({{ $c->percentage }}%)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Highest Score -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <span class="flex items-center gap-2">
                                    <span>🎯</span>
                                    <span>Highest Score</span>
                                </span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <input type="number" name="highest_score" min="1"
                                    class="pl-10 w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                    placeholder="100" required>
                            </div>
                        </div>

                        <!-- Assessment Type -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <span class="flex items-center gap-2">
                                    <span>📅</span>
                                    <span>Assessmen Term</span>
                                </span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <select name="type"
                                    class="pl-10 w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                    required>
                                    <option value="" class="text-gray-400">Select type</option>
                                    <option value="Midterm">Midterm</option>
                                    <option value="Final">Final</option>
                                </select>
                            </div>
                        </div>

                        <!-- Assessment Date -->
                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <span class="flex items-center gap-2">
                                    <span>📆</span>
                                    <span>Assessment Date</span>
                                </span>
                            </label>
                            <div class="relative max-w-md">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="date" name="date"
                                    class="pl-10 w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end gap-3 pt-8 border-t border-gray-200">
                        <button type="button" id="closeAssessmentModal"
                            class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-all duration-300 border border-gray-300 flex items-center gap-2">
                            Cancel
                        </button>
                        <button type="submit" id="submitAssessmentBtn"
                            class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-medium rounded-xl hover:from-indigo-600 hover:to-blue-700 transition-all duration-300 shadow-sm hover:shadow flex items-center gap-2">
                            <span id="submitText">Create Assessment</span>
                            <span id="submitSpinner" class="hidden">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Existing Assessments Section -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                            <span>📋</span>
                            <span>Existing Assessments</span>
                            <span class="text-sm font-normal bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                                {{ $assessments->count() }}
                            </span>
                        </h3>
                        <button class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            Refresh
                        </button>
                    </div>

                    <div class="bg-gray-50 rounded-2xl border border-gray-200 overflow-hidden">
                        <div class="overflow-y-auto max-h-64">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100 sticky top-0">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Title
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">
                                            Component</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Max
                                            Score</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Type
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Date
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="assessmentList" class="divide-y divide-gray-200">
                                    @foreach($assessments as $a)
                                        <tr class="hover:bg-white transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="font-medium text-gray-900">{{ $a->title }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                    {{ $a->gradingCriteria->component_name ?? '-' }}
                                                    ({{ $a->gradingCriteria->percentage ?? 0 }}%)
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="font-semibold text-gray-900">{{ $a->highest_score }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                                {{ $a->type == 'Midterm' ? 'bg-yellow-100 text-yellow-800' : 'bg-purple-100 text-purple-800' }}">
                                                    {{ $a->type }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $a->date ? \Carbon\Carbon::parse($a->date)->format('M d, Y') : '-' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2">
                                                    <button onclick="editAssessment({{ $a->id }})"
                                                        class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors flex items-center gap-1">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                            </path>
                                                        </svg>
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('assessments.destroy', $a->id) }}" method="POST"
                                                        class="inline-block"
                                                        onsubmit="return confirm('Are you sure you want to delete this assessment?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors flex items-center gap-1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                </path>
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Assessment Modal -->
    <div id="editAssessmentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg w-96 max-w-full shadow-xl">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Assessment</h2>

            <input type="hidden" id="assessment_id">

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" id="title"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Highest Score</label>
                    <input type="number" id="highest_score"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select id="type"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="Midterm">Midterm</option>
                        <option value="Final">Final</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" id="date"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Grading Criteria</label>
                    <select id="grading_criteria_id"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"></select>
                </div>
            </div>

            <div class="flex justify-end mt-6 space-x-2">
                <button onclick="closeEditModal()"
                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded transition">Cancel</button>
                <button onclick="updateAssessment()"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition">Save</button>
            </div>
        </div>
    </div>

    @php
        $totalPercentage = $criteriaList->sum('percentage');
        $remaining = 100 - $totalPercentage;
    @endphp

    <!-- ==================== BAGONG CRITERIA MODAL NA MAY LIVEWIRE ==================== -->
    <!-- Criteria Modal -->
    <div id="criteriaModal"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center hidden z-50 animate-fadeIn">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-8 w-full max-w-4xl shadow-2xl relative 
                    transform transition-all duration-300 scale-95 modal-enter
                    max-h-[90vh] overflow-y-auto">

            <!-- Close Button -->
            <button id="closeCriteriaModal"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- LIVEWIRE COMPONENT - ITO ANG MAG-AUTOMATIC UPDATE -->
            <livewire:grading-components :classId="$classId" />
        </div>
    </div>

    <!-- Upload Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-3xl shadow-lg relative">
            <h3 class="text-lg font-semibold mb-4">📂 Select Excel File</h3>
            <input type="file" id="excelFile" accept=".xlsx,.xls"
                class="block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 mb-4">
            <div class="flex justify-end gap-2">
                <button id="closeModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-5xl shadow-lg relative">
            <h3 class="font-semibold text-gray-700 mb-4">📋 Preview Students</h3>
            <form id="saveForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="overflow-x-auto max-h-96 border rounded shadow-sm">
                    <table id="previewTable" class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th class="border px-2 py-1 text-left text-sm font-medium text-gray-700">Reg #</th>
                                <th class="border px-2 py-1 text-left text-sm font-medium text-gray-700">Student #</th>
                                <th class="border px-2 py-1 text-left text-sm font-medium text-gray-700">Student Name</th>
                                <th class="border px-2 py-1 text-left text-sm font-medium text-gray-700">Barangay</th>
                                <th class="border px-2 py-1 text-left text-sm font-medium text-gray-700">City/Municipality
                                </th>
                                <th class="border px-2 py-1 text-left text-sm font-medium text-gray-700">Province</th>
                                <th class="border px-2 py-1 text-left text-sm font-medium text-gray-700">DOB</th>
                                <th class="border px-2 py-1 text-left text-sm font-medium text-gray-700">Sex</th>
                                <th class="border px-2 py-1 text-left text-sm font-medium text-gray-700">Mobile #</th>
                                <th class="border px-2 py-1 text-left text-sm font-medium text-gray-700">Email</th>
                            </tr>
                        </thead>
                        <tbody class="odd:bg-white even:bg-gray-50"></tbody>
                    </table>
                </div>
                <input type="hidden" name="file_data" id="fileData">
                <input type="hidden" name="class_id" value="{{ $classId }}">
                <div class="flex justify-end mt-4">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow hover:shadow-lg transition">💾
                        Save to Database</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes modalIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .animate-modalIn {
            animation: modalIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px) scale(0.95);
                opacity: 0;
            }

            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        .modal-enter {
            animation: slideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Add to your existing styles */
        .score-input.valid {
            border-color: #10b981;
            background-color: #f0fdf4;
            box-shadow: 0 0 0 1px #10b981;
        }

        .score-input.invalid {
            border-color: #ef4444;
            background-color: #fef2f2;
            box-shadow: 0 0 0 1px #ef4444;
            animation: shake 0.3s ease-in-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .input-error-tooltip {
            position: absolute;
            top: -30px;
            left: 0;
            background-color: #ef4444;
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.2s ease-out;
            z-index: 50;
            white-space: nowrap;
        }

        .input-error-tooltip::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 10px;
            width: 8px;
            height: 8px;
            background-color: #ef4444;
            transform: rotate(45deg);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Success state for inputs */
        .score-input.valid {
            border-color: #10b981;
            background-color: #f0fdf4;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2310b981'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 1.2rem;
            padding-right: 2.5rem;
        }

        /* Loading state for inputs */
        .score-input.loading {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236366f1'%3E%3Ccircle class='opacity-25' cx='12' cy='12' r='10' stroke='currentColor' stroke-width='4'%3E%3C/circle%3E%3Cpath class='opacity-75' fill='currentColor' d='M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 1.2rem;
            animation: spin 1s linear infinite;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        // ==================== GLOBAL FUNCTIONS ====================
        // Make loadStudents globally available
        window.loadStudents = async function () {
            try {
                console.log('Loading students...'); // Debug log

                const studentTableBody = document.getElementById('studentTableBody');
                const groupHeader = document.getElementById('groupHeader');
                const typeHeader = document.getElementById('typeHeader');
                const assessmentHeader = document.getElementById('assessmentHeader');
                const highestScoreHeader = document.getElementById('highestScoreHeader');

                // Reset headers
                if (groupHeader) {
                    groupHeader.innerHTML = `
                        <th rowspan="3" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gray-100">
                            <div class="flex items-center gap-2">
                                <span>#</span>
                                <span>Student Number</span>
                            </div>
                        </th>
                        <th rowspan="3" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider bg-gray-100">
                            <div class="flex items-center gap-2">
                                <span>👤</span>
                                <span>Student Name</span>
                            </div>
                        </th>
                    `;
                }

                if (typeHeader) typeHeader.innerHTML = '';
                if (assessmentHeader) assessmentHeader.innerHTML = '';
                if (highestScoreHeader) highestScoreHeader.innerHTML = '<th colspan="2" class="border px-2 py-1 bg-gray-100 font-semibold text-sm text-center">Highest Possible Score </th>';

                // Show loading state
                if (studentTableBody) {
                    studentTableBody.innerHTML = `
                        <tr>
                            <td colspan="100" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 font-medium">Loading students...</p>
                                        <p class="text-sm text-gray-400 mt-1">Please wait while we fetch student data</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    `;
                }

                const res = await axios.get("{{ route('students.get') }}", {
                    params: { class_id: "{{ $classId }}" }
                });

                console.log('Students loaded:', res.data); // Debug log

                const { students: studentData = [], assessments = {} } = res.data || {};
                window.students = studentData; // Store globally for other functions

                let overallMaxTotal = 0;

                // Build grouped headers
                Object.entries(assessments).forEach(([component, items]) => {
                    let componentMax = 0;

                    // Per assessment highest score
                    items.forEach(a => {
                        componentMax += Number(a.highest_score);

                        if (highestScoreHeader) {
                            highestScoreHeader.innerHTML += `
                                <th class="border px-2 py-1 text-center bg-gray-100 font-semibold">
                                    ${a.highest_score}
                                </th>
                            `;
                        }
                    });

                    // TOTAL column
                    if (highestScoreHeader) {
                        highestScoreHeader.innerHTML += `
                            <th class="border px-2 py-1 text-center bg-yellow-100 font-semibold">
                                ${componentMax}
                            </th>
                        `;
                    }

                    // % column
                    const componentWeight = items[0].criteria?.percentage || 0;
                    if (highestScoreHeader) {
                        highestScoreHeader.innerHTML += `
                            <th class="border px-2 py-1 text-center bg-green-100 font-semibold">
                                ${componentWeight}
                            </th>
                        `;
                    }

                    overallMaxTotal += componentWeight;

                    // Group assessments by type (Midterm / Final)
                    const byType = items.reduce((acc, a) => {
                        acc[a.type] = acc[a.type] || [];
                        acc[a.type].push(a);
                        return acc;
                    }, {});

                    // Add the group header (component)
                    if (groupHeader) {
                        groupHeader.innerHTML += `<th colspan="${items.length + 2}" class="border px-2 py-1 text-center font-semibold bg-gray-200">${component}</th>`;
                    }

                    // Type headers (Midterm / Final)
                    Object.entries(byType).forEach(([type, list]) => {
                        if (typeHeader) {
                            typeHeader.innerHTML += `
                                <th colspan="${list.length}" class="border px-2 py-1 text-center font-semibold bg-gray-100">
                                    ${type}
                                </th>
                            `;
                        }
                    });

                    // Total & % (rowspan=2)
                    if (typeHeader) {
                        typeHeader.innerHTML += `
                            <th rowspan="2"
                                class="border px-2 py-1 text-center font-semibold bg-yellow-100">
                                Total
                            </th>
                            <th rowspan="2"
                                class="border px-2 py-1 text-center font-semibold bg-green-100">
                                %
                            </th>
                        `;
                    }

                    items.forEach(a => {
                        if (assessmentHeader) {
                            assessmentHeader.innerHTML += `
                                <th class="border px-2 py-1 text-center text-sm">
                                    <div class="font-medium">${a.title}</div>
                                </th>
                            `;
                        }
                    });
                });

                // Add final headers
                if (highestScoreHeader) {
                    highestScoreHeader.innerHTML += `
                        <th class="border px-2 py-1 text-center bg-yellow-200 font-bold">
                            ${overallMaxTotal}
                        </th>
                        <th class="border px-2 py-1 text-center bg-blue-100 font-bold">
                            1
                        </th>
                        <th class="border px-2 py-1 text-center bg-green-100 font-bold">
                            PASSED
                        </th>
                    `;
                }

                if (groupHeader) {
                    groupHeader.innerHTML += `
                        <th rowspan="3" class="border px-2 py-1 text-center font-bold bg-yellow-200">
                            Total Grade
                        </th>
                        <th rowspan="3" class="border px-2 py-1 text-center font-bold bg-blue-200">
                            Equivalent Grade
                        </th>
                        <th rowspan="3" class="border px-2 py-1 text-center font-bold bg-green-200">
                            Remarks
                        </th>
                    `;
                }

                // Build student rows
                if (!studentData || studentData.length === 0) {
                    if (studentTableBody) {
                        studentTableBody.innerHTML = `
                            <tr>
                                <td colspan="100" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 3.75a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75A2.25 2.25 0 013 4.5h15a2.25 2.25 0 012.25 2.25v12z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 font-medium">No students found</p>
                                            <p class="text-sm text-gray-400 mt-1">Upload students using the Excel upload button</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        `;
                    }

                    // Update count display
                    const countDisplay = document.getElementById('studentCountDisplay');
                    if (countDisplay) {
                        countDisplay.textContent = 'Total students: 0';
                    }

                    return;
                }

                if (studentTableBody) {
                    studentTableBody.innerHTML = '';

                    studentData.forEach((s, index) => {
                        let row = `<tr class="hover:bg-gray-50 transition-colors" data-student-id="${s.id}">
                            <td class="border px-6 py-4 whitespace-nowrap font-medium">${s.student_number || ''}</td>
                            <td class="border px-6 py-4 whitespace-nowrap student-name-cell">${s.student_name || ''}</td>
                        `;

                        let totalGrade = 0;

                        // Loop per grading component
                        Object.values(assessments).forEach(items => {
                            let total = 0;
                            let maxTotal = 0;

                            // Individual assessment scores
                            items.forEach(a => {
                                const scoreObj = s.scores?.find(sc => sc.assessment_id == a.id);
                                const score = scoreObj ? Number(scoreObj.score) : '—';

                                if (scoreObj) total += Number(scoreObj.score);
                                maxTotal += Number(a.highest_score);

                                row += `
                                    <td class="border px-6 py-4 whitespace-nowrap text-center ${scoreObj ? 'text-gray-900' : 'text-gray-400'}">
                                        ${score}
                                    </td>
                                `;
                            });

                            // TOTAL (sum per component)
                            row += `
                                <td class="border px-6 py-4 whitespace-nowrap text-center font-semibold bg-yellow-50">
                                    ${total}
                                </td>
                            `;

                            // WEIGHTED %
                            const componentWeight = items[0].criteria?.percentage || 0;
                            const weighted = maxTotal ? ((total / maxTotal) * componentWeight) : 0;
                            totalGrade += weighted;

                            row += `
                                <td class="border px-6 py-4 whitespace-nowrap text-center font-semibold bg-green-50">
                                    ${weighted.toFixed(2)}
                                </td>
                            `;
                        });

                        // Total Grade
                        row += `
                            <td class="border px-6 py-4 whitespace-nowrap text-center font-bold bg-yellow-200">
                                ${totalGrade.toFixed(2)}
                            </td>
                        `;

                        // Equivalent Grade
                        let eqGrade;
                        if (totalGrade >= 98) eqGrade = '1.00';
                        else if (totalGrade >= 95) eqGrade = '1.25';
                        else if (totalGrade >= 92) eqGrade = '1.50';
                        else if (totalGrade >= 89) eqGrade = '1.75';
                        else if (totalGrade >= 86) eqGrade = '2.00';
                        else if (totalGrade >= 83) eqGrade = '2.25';
                        else if (totalGrade >= 80) eqGrade = '2.50';
                        else if (totalGrade >= 77) eqGrade = '2.75';
                        else if (totalGrade >= 75) eqGrade = '3.00';
                        else eqGrade = '5.00';

                        row += `
                            <td class="border px-6 py-4 whitespace-nowrap text-center font-semibold bg-blue-100">
                                ${eqGrade}
                            </td>
                        `;

                        // Remarks
                        const remarks = totalGrade >= 75 ? 'PASSED' : 'FAILED';
                        const remarkBg = totalGrade >= 75 ? 'bg-green-100' : 'bg-red-100';

                        row += `
                            <td class="border px-6 py-4 whitespace-nowrap text-center font-semibold ${remarkBg}">
                                ${remarks}
                            </td>
                        `;

                        row += '</tr>';
                        studentTableBody.innerHTML += row;
                    });
                }

                // Update stats cards if they exist
                const totalStudentsEl = document.querySelector('.bg-blue-100 + div p:last-child');
                if (totalStudentsEl) totalStudentsEl.textContent = studentData.length;

                // Update count display
                const countDisplay = document.getElementById('studentCountDisplay');
                if (countDisplay) {
                    countDisplay.textContent = `Total students: ${studentData.length}`;
                }

                console.log('Students loaded successfully'); // Debug log

            } catch (err) {
                console.error('Error loading students:', err);
                const studentTableBody = document.getElementById('studentTableBody');
                if (studentTableBody) {
                    studentTableBody.innerHTML = `
                        <tr>
                            <td colspan="100" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-red-500 font-medium">Failed to load students</p>
                                        <p class="text-sm text-gray-400 mt-1">Please try refreshing the page</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    `;
                }
            }
        };

        // ==================== SEARCH FUNCTIONALITY ====================
        // Search functionality
        function filterStudents() {
            const searchInput = document.getElementById('studentSearch');
            const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const tableBody = document.getElementById('studentTableBody');
            const clearBtn = document.getElementById('clearSearch');
            const searchStats = document.getElementById('searchStats');
            const visibleCountSpan = document.getElementById('visibleCount');

            if (!tableBody) return;

            const rows = tableBody.getElementsByTagName('tr');
            let visibleCount = 0;

            // Show/hide clear button
            if (clearBtn) {
                if (searchTerm.length > 0) {
                    clearBtn.classList.remove('hidden');
                } else {
                    clearBtn.classList.add('hidden');
                }
            }

            // Filter rows
            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const nameCell = row.querySelector('.student-name-cell') || row.cells[1]; // Student name is in the second column

                if (nameCell) {
                    const studentName = nameCell.textContent.toLowerCase();

                    if (searchTerm === '' || studentName.includes(searchTerm)) {
                        row.classList.remove('hidden');
                        visibleCount++;

                        // Highlight the matching text if there's a search term
                        if (searchTerm !== '' && studentName.includes(searchTerm)) {
                            // Remove any existing highlights
                            const originalText = nameCell.textContent;

                            // Highlight the matching part
                            const regex = new RegExp(`(${searchTerm})`, 'gi');
                            nameCell.innerHTML = originalText.replace(regex, '<span class="bg-yellow-200 px-0.5 rounded">$1</span>');

                            // Add highlight animation class
                            row.classList.add('search-highlight');
                            setTimeout(() => {
                                row.classList.remove('search-highlight');
                            }, 1500);
                        } else {
                            // Restore original text without highlights
                            nameCell.innerHTML = nameCell.textContent;
                        }
                    } else {
                        row.classList.add('hidden');
                    }
                }
            }

            // Update search stats
            if (searchStats && visibleCountSpan) {
                if (searchTerm.length > 0) {
                    visibleCountSpan.textContent = visibleCount;
                    searchStats.classList.remove('hidden');

                    // Update the main count display
                    const countDisplay = document.getElementById('studentCountDisplay');
                    if (countDisplay) {
                        const totalStudents = rows.length;
                        countDisplay.innerHTML = `Showing <span class="font-semibold">${visibleCount}</span> of <span class="font-semibold">${totalStudents}</span> students`;
                    }

                    // Show "no results" message if needed
                    const existingNoResults = document.getElementById('noResultsMessage');

                    if (visibleCount === 0) {
                        if (!existingNoResults) {
                            const noResultsRow = document.createElement('tr');
                            noResultsRow.id = 'noResultsMessage';
                            noResultsRow.innerHTML = `
                                <td colspan="100" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 font-medium">No students found</p>
                                            <p class="text-sm text-gray-400 mt-1">Try adjusting your search term</p>
                                        </div>
                                    </div>
                                </td>
                            `;
                            tableBody.appendChild(noResultsRow);
                        }
                    } else {
                        if (existingNoResults) {
                            existingNoResults.remove();
                        }
                    }
                } else {
                    searchStats.classList.add('hidden');

                    // Remove any no results message
                    const existingNoResults = document.getElementById('noResultsMessage');
                    if (existingNoResults) {
                        existingNoResults.remove();
                    }

                    // Restore original count display
                    const countDisplay = document.getElementById('studentCountDisplay');
                    if (countDisplay) {
                        const totalStudents = rows.length;
                        countDisplay.textContent = `Total students: ${totalStudents}`;
                    }

                    // Remove all highlights
                    for (let i = 0; i < rows.length; i++) {
                        const row = rows[i];
                        const nameCell = row.querySelector('.student-name-cell') || row.cells[1];
                        if (nameCell) {
                            nameCell.innerHTML = nameCell.textContent;
                        }
                    }
                }
            }
        }

        // Clear search
        function clearSearch() {
            const searchInput = document.getElementById('studentSearch');
            if (searchInput) {
                searchInput.value = '';
                filterStudents();
                searchInput.focus();
            }
        }

        // Add debounce to improve performance
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // ==================== UTILITY FUNCTIONS ====================
        function showAlert(type, message) {
            const alertElement = document.getElementById(type === 'success' ? 'successAlert' : 'errorAlert');
            const messageElement = document.getElementById(type === 'success' ? 'successMessage' : 'errorMessage');

            if (!alertElement || !messageElement) return;

            messageElement.textContent = message;

            alertElement.classList.remove('hidden', 'opacity-0', '-translate-y-2');
            alertElement.classList.add('opacity-100', 'translate-y-0');

            setTimeout(() => {
                alertElement.classList.add('opacity-0', '-translate-y-2');
                setTimeout(() => {
                    alertElement.classList.add('hidden');
                    alertElement.classList.remove('translate-y-0');
                }, 500);
            }, 5000);
        }

        function closeEditModal() {
            const editModal = document.getElementById('editAssessmentModal');
            if (editModal) {
                editModal.classList.add('hidden');
                editModal.style.zIndex = '';
            }
        }

        function toggleGradingSheetDropdown() {
            const dropdown = document.getElementById('gradingSheetDropdown');
            const arrow = document.getElementById('dropdownArrow');

            if (dropdown && arrow) {
                dropdown.classList.toggle('hidden');
                dropdown.classList.toggle('show');
                arrow.classList.toggle('rotate');

                if (!dropdown.classList.contains('hidden')) {
                    setTimeout(() => {
                        document.addEventListener('click', closeDropdownOnClickOutside);
                    }, 10);
                }
            }
        }

        function closeDropdownOnClickOutside(event) {
            const dropdown = document.getElementById('gradingSheetDropdown');
            const button = event.target.closest('button[onclick*="toggleGradingSheetDropdown"]');

            if (dropdown && !dropdown.contains(event.target) && !button) {
                dropdown.classList.add('hidden');
                dropdown.classList.remove('show');
                const arrow = document.getElementById('dropdownArrow');
                if (arrow) arrow.classList.remove('rotate');
                document.removeEventListener('click', closeDropdownOnClickOutside);
            }
        }

        // ==================== EDIT ASSESSMENT FUNCTIONS ====================
        window.editAssessment = function (id) {
            fetch(`/assessments/${id}/edit`)
                .then(res => {
                    const contentType = res.headers.get("content-type");
                    if (contentType && contentType.includes("application/json")) {
                        return res.json();
                    } else {
                        return res.text().then(text => {
                            console.error('Non-JSON response:', text.substring(0, 200));
                            throw new Error('Server returned non-JSON response');
                        });
                    }
                })
                .then(data => {
                    console.log('Edit data received:', data);
                    const a = data.assessment;

                    document.getElementById('assessment_id').value = a.id;
                    document.getElementById('title').value = a.title;
                    document.getElementById('highest_score').value = a.highest_score;
                    document.getElementById('type').value = a.type;
                    document.getElementById('date').value = a.date;

                    const gradingSelect = document.getElementById('grading_criteria_id');
                    if (gradingSelect) {
                        gradingSelect.innerHTML = '';

                        if (data.criteria && Array.isArray(data.criteria)) {
                            data.criteria.forEach(c => {
                                const option = document.createElement('option');
                                option.value = c.id;
                                option.text = `${c.component_name} (${c.percentage}%)`;
                                if (c.id == a.grading_criteria_id) option.selected = true;
                                gradingSelect.appendChild(option);
                            });
                        }
                    }

                    const editModal = document.getElementById('editAssessmentModal');
                    if (editModal) {
                        editModal.classList.remove('hidden');
                        editModal.style.zIndex = '9999';
                    }
                })
                .catch(err => {
                    console.error('Fetch error:', err);
                    alert('Error loading assessment data. Please check console for details.');
                });
        };

        window.updateAssessment = function () {
            const id = document.getElementById('assessment_id').value;

            const data = {
                title: document.getElementById('title').value,
                highest_score: document.getElementById('highest_score').value,
                type: document.getElementById('type').value,
                date: document.getElementById('date').value,
                grading_criteria_id: document.getElementById('grading_criteria_id').value,
                _token: '{{ csrf_token() }}'
            };

            if (!data.title || !data.highest_score || !data.type || !data.date || !data.grading_criteria_id) {
                alert('Please fill all required fields!');
                return;
            }

            const saveBtn = document.querySelector('#editAssessmentModal button[onclick="updateAssessment()"]');
            if (saveBtn) {
                saveBtn.innerHTML = '<span class="inline-block animate-spin mr-2">⟳</span>Saving...';
                saveBtn.disabled = true;
            }

            const formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('title', data.title);
            formData.append('highest_score', data.highest_score);
            formData.append('type', data.type);
            formData.append('date', data.date);
            formData.append('grading_criteria_id', data.grading_criteria_id);
            formData.append('_token', data._token);

            fetch(`/assessments/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(res => res.json())
                .then(resData => {
                    if (saveBtn) {
                        saveBtn.innerHTML = 'Save';
                        saveBtn.disabled = false;
                    }

                    if (resData.success) {
                        closeEditModal();

                        // Refresh the students table
                        if (typeof window.loadStudents === 'function') {
                            setTimeout(() => {
                                window.loadStudents();
                            }, 500);
                        }

                        showAlert('success', 'Assessment updated successfully!');
                    } else {
                        alert(resData.message || 'Failed to update assessment.');
                    }
                })
                .catch(err => {
                    console.error('Update error:', err);
                    if (saveBtn) {
                        saveBtn.innerHTML = 'Save';
                        saveBtn.disabled = false;
                    }
                    alert('Error updating assessment: ' + err.message);
                });
        };

        // ==================== DOCUMENT READY ====================
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Document ready, loading students...'); // Debug log

            // Initial load of students
            window.loadStudents();

            // ----------------- SEARCH SETUP -----------------
            const searchInput = document.getElementById('studentSearch');
            if (searchInput) {
                // Use debounced search for better performance
                const debouncedFilter = debounce(filterStudents, 300);
                searchInput.addEventListener('keyup', debouncedFilter);

                // Also handle paste event
                searchInput.addEventListener('paste', function () {
                    setTimeout(debouncedFilter, 100);
                });
            }

            // ----------------- MODAL ELEMENTS -----------------
            const assessmentModal = document.getElementById('assessmentModal');
            const openAssessmentModalBtn = document.getElementById('openAssessmentModal');
            const closeAssessmentModal = document.getElementById('closeAssessmentModal');
            const closeAssessmentModalX = document.getElementById('closeAssessmentModalX');

            const criteriaModal = document.getElementById('criteriaModal');
            const openCriteriaModalBtn = document.getElementById('openCriteriaModal');
            const closeCriteriaModal = document.getElementById('closeCriteriaModal');
            const closeCriteriaModal2 = document.getElementById('closeCriteriaModal2');

            const scoresModal = document.getElementById('scoresModal');
            const openScoresModalBtn = document.getElementById('openScoresModal');
            const closeScoresModal = document.getElementById('closeScoresModal');
            const closeScoresModal2 = document.getElementById('closeScoresModal2');

            const uploadModal = document.getElementById('uploadModal');
            const uploadBtn = document.getElementById('uploadBtn');
            const closeUploadModal = document.getElementById('closeModal');
            const excelFileInput = document.getElementById('excelFile');

            const previewModal = document.getElementById('previewModal');
            const saveForm = document.getElementById('saveForm');
            const fileDataInput = document.getElementById('fileData');
            const previewTableBody = document.querySelector('#previewTable tbody');

            const scoreAssessmentSelect = document.getElementById('scoreAssessmentSelect');
            const scoresTableBody = document.getElementById('scoresTableBody');
            const scoresForm = document.getElementById('scoresForm');

            const assessmentForm = document.getElementById('assessmentForm');
            const submitAssessmentBtn = document.getElementById('submitAssessmentBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');

            // ----------------- MODAL FUNCTIONS -----------------
            function showModal(modal) {
                if (modal) {
                    modal.classList.remove('hidden');
                }
            }

            function hideModal(modal) {
                if (modal) {
                    modal.classList.add('hidden');
                }
            }

            // Assessment Modal
            if (openAssessmentModalBtn) {
                openAssessmentModalBtn.addEventListener('click', () => showModal(assessmentModal));
            }

            [closeAssessmentModal, closeAssessmentModalX].forEach(btn => {
                if (btn) btn.addEventListener('click', () => hideModal(assessmentModal));
            });

            // Criteria Modal
            if (openCriteriaModalBtn) {
                openCriteriaModalBtn.addEventListener('click', () => showModal(criteriaModal));
            }

            [closeCriteriaModal, closeCriteriaModal2].forEach(btn => {
                if (btn) btn.addEventListener('click', () => hideModal(criteriaModal));
            });

            // Close criteria modal when clicking outside
            if (criteriaModal) {
                criteriaModal.addEventListener('click', (e) => {
                    if (e.target === criteriaModal) {
                        hideModal(criteriaModal);
                    }
                });
            }

            // Scores Modal
            if (openScoresModalBtn) {
                openScoresModalBtn.addEventListener('click', () => {
                    closeEditModal();
                    showModal(scoresModal);
                });
            }

            [closeScoresModal, closeScoresModal2].forEach(btn => {
                if (btn) btn.addEventListener('click', () => hideModal(scoresModal));
            });

            // Upload Modal
            if (uploadBtn) {
                uploadBtn.addEventListener('click', () => {
                    closeEditModal();
                    showModal(uploadModal);
                });
            }

            if (closeUploadModal) {
                closeUploadModal.addEventListener('click', () => hideModal(uploadModal));
            }

            // ==================== ASSESSMENT FORM SUBMISSION ====================
            if (assessmentForm) {
                assessmentForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    if (submitText) submitText.textContent = 'Adding...';
                    if (submitSpinner) submitSpinner.classList.remove('hidden');
                    if (submitAssessmentBtn) submitAssessmentBtn.disabled = true;

                    try {
                        const formData = new FormData(assessmentForm);

                        const formDataObj = {};
                        formData.forEach((value, key) => {
                            formDataObj[key] = value;
                        });

                        console.log('Submitting assessment:', formDataObj);

                        const response = await fetch("{{ route('assessments.store') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(formDataObj)
                        });

                        const data = await response.json();
                        console.log('Assessment response:', data);

                        if (submitText) submitText.textContent = 'Add Assessment';
                        if (submitSpinner) submitSpinner.classList.add('hidden');
                        if (submitAssessmentBtn) submitAssessmentBtn.disabled = false;

                        if (data.success) {
                            // Show success message
                            showAlert('success', data.message || 'Assessment added successfully!');

                            // Reset the form but keep modal open
                            assessmentForm.reset();

                            // Add the new assessment to the existing table dynamically
                            // Check if assessment data is in the response
                            const newAssessment = data.assessment || data.data;
                            if (newAssessment) {
                                addAssessmentToTable(newAssessment);
                            }

                            // Refresh the students table to update headers
                            window.loadStudents();

                            // Optional: Show a small toast that it was added successfully
                            showToast('Assessment added successfully!');

                        } else {
                            showAlert('error', data.message || 'Failed to add assessment');
                        }

                    } catch (error) {
                        console.error('Error adding assessment:', error);
                        showAlert('error', 'An error occurred while adding the assessment');

                        if (submitText) submitText.textContent = 'Add Assessment';
                        if (submitSpinner) submitSpinner.classList.add('hidden');
                        if (submitAssessmentBtn) submitAssessmentBtn.disabled = false;
                    }
                });
            }

            // Function to add assessment to the existing table without reloading the page
            function addAssessmentToTable(assessment) {
                const assessmentList = document.getElementById('assessmentList');
                if (!assessmentList) return;

                // Create new row
                const newRow = document.createElement('tr');
                newRow.className = 'hover:bg-white transition-colors';
                newRow.setAttribute('data-assessment-id', assessment.id);

                // Format date
                const formattedDate = assessment.date ? new Date(assessment.date).toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                }) : '-';

                // Determine type class
                const typeClass = assessment.type === 'Midterm' ? 'bg-yellow-100 text-yellow-800' : 'bg-purple-100 text-purple-800';

                // Get criteria name and percentage
                const criteriaName = assessment.criteria_name ||
                    (assessment.grading_criteria ? assessment.grading_criteria.component_name : 'No Category');
                const criteriaPercentage = assessment.criteria_percentage ||
                    (assessment.grading_criteria ? assessment.grading_criteria.percentage : 0);

                // Create the delete form with proper Laravel route
                const deleteFormAction = `/assessments/${assessment.id}`;

                newRow.innerHTML = `
            <td class="px-6 py-4">
                <div class="font-medium text-gray-900">${escapeHtml(assessment.title)}</div>
            </td>
            <td class="px-6 py-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    ${escapeHtml(criteriaName)} (${criteriaPercentage}%)
                </span>
            </td>
            <td class="px-6 py-4">
                <span class="font-semibold text-gray-900">${escapeHtml(assessment.highest_score)}</span>
            </td>
            <td class="px-6 py-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${typeClass}">
                    ${escapeHtml(assessment.type)}
                </span>
            </td>
            <td class="px-6 py-4 text-sm text-gray-500">
                ${formattedDate}
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center gap-2">
                    <button onclick="editAssessment(${assessment.id})"
                        class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit
                    </button>
                    <form action="${deleteFormAction}" method="POST"
                        class="inline-block delete-assessment-form"
                        onsubmit="return confirm('Are you sure you want to delete this assessment?');">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit"
                            class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </td>
        `;

                // Add animation class
                newRow.style.animation = 'fadeIn 0.5s ease-in-out';

                // Append to the table
                assessmentList.appendChild(newRow);

                // Update the count
                updateAssessmentCount();

                // Also update the assessment dropdown in scores modal
                updateAssessmentDropdown(assessment);
            }

            // Helper function to escape HTML
            function escapeHtml(text) {
                if (!text) return '';
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // Function to update the assessment count badge
            function updateAssessmentCount() {
                const countBadge = document.querySelector('.bg-blue-100.text-blue-700.px-3.py-1.rounded-full');
                if (countBadge) {
                    const currentCount = document.querySelectorAll('#assessmentList tr').length;
                    countBadge.textContent = currentCount;
                }

                // Update the stats card
                const assessmentsCountEl = document.querySelector('.bg-purple-100 + div p:last-child');
                if (assessmentsCountEl) {
                    const currentCount = document.querySelectorAll('#assessmentList tr').length;
                    assessmentsCountEl.textContent = currentCount;
                }
            }

            // Function to show a temporary toast message
            function showToast(message) {
                // Create toast element if it doesn't exist
                let toast = document.getElementById('successToast');
                if (!toast) {
                    toast = document.createElement('div');
                    toast.id = 'successToast';
                    toast.className = 'fixed bottom-4 right-4 bg-white rounded-xl shadow-2xl border-l-4 border-green-500 p-4 transform transition-all duration-500 translate-y-20 opacity-0 z-50';
                    toast.innerHTML = `
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-slate-800">Success!</p>
                        <p class="text-sm text-slate-500" id="toastMessage">Assessment added successfully</p>
                    </div>
                </div>
            `;
                    document.body.appendChild(toast);
                }

                const toastMessage = document.getElementById('toastMessage') || toast.querySelector('p:last-child');
                if (toastMessage) {
                    toastMessage.textContent = message;
                }

                // Show toast
                toast.classList.remove('translate-y-20', 'opacity-0');
                toast.classList.add('translate-y-0', 'opacity-100');

                // Hide after 3 seconds
                setTimeout(() => {
                    toast.classList.remove('translate-y-0', 'opacity-100');
                    toast.classList.add('translate-y-20', 'opacity-0');
                }, 3000);
            }

            // Also update the assessment select dropdown when a new assessment is added
            function updateAssessmentDropdown(assessment) {
                const scoreAssessmentSelect = document.getElementById('scoreAssessmentSelect');
                if (!scoreAssessmentSelect) return;

                const option = document.createElement('option');
                option.value = assessment.id;
                option.setAttribute('data-highest', assessment.highest_score);
                option.setAttribute('data-category', assessment.criteria_name || assessment.grading_criteria?.component_name || 'No Category');
                option.textContent = `${assessment.title} • ${assessment.criteria_name || assessment.grading_criteria?.component_name || 'No Category'} • Max: ${assessment.highest_score}`;
                option.className = 'py-2';

                scoreAssessmentSelect.appendChild(option);
            }

            // ----------------- SCORES FORM SUBMISSION -----------------
            if (scoreAssessmentSelect) {
                scoreAssessmentSelect.addEventListener('change', () => {
                    const assessmentId = scoreAssessmentSelect.value;
                    const maxScore = scoreAssessmentSelect.selectedOptions[0]?.dataset.highest || 100;
                    const maxScoreDisplay = document.getElementById('maxScoreDisplay');
                    const maxScoreDisplay2 = document.getElementById('maxScoreDisplay2');

                    if (maxScoreDisplay) {
                        maxScoreDisplay.textContent = maxScore;
                    }
                    if (maxScoreDisplay2) {
                        maxScoreDisplay2.textContent = maxScore;
                    }

                    // Show assessment info
                    const assessmentInfo = document.getElementById('assessmentInfo');
                    const assessmentCategory = document.getElementById('assessmentCategory');

                    if (assessmentId && assessmentInfo) {
                        assessmentInfo.classList.remove('hidden');
                        if (assessmentCategory) {
                            assessmentCategory.textContent = scoreAssessmentSelect.selectedOptions[0]?.dataset.category || 'General';
                        }
                    } else if (assessmentInfo) {
                        assessmentInfo.classList.add('hidden');
                    }

                    if (scoresTableBody) {
                        if (!assessmentId || !window.students || window.students.length === 0) {
                            scoresTableBody.innerHTML = `
                                <tr id="noStudentsMessage">
                                    <td colspan="3" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center gap-3">
                                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 3.75a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75A2.25 2.25 0 013 4.5h15a2.25 2.25 0 012.25 2.25v12z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-gray-500 font-medium">${!assessmentId ? 'Select an assessment first' : 'No students found'}</p>
                                                <p class="text-sm text-gray-400 mt-1">${!assessmentId ? 'Choose an assessment from the dropdown above' : 'Upload students first'}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            `;
                            return;
                        }

                        scoresTableBody.innerHTML = '';

                        window.students.forEach(s => {
                            const tr = document.createElement('tr');
                            tr.className = 'hover:bg-gray-50 transition-colors';

                            // Get existing score if available
                            const existingScore = s.scores?.find(sc => sc.assessment_id == assessmentId);

                            tr.innerHTML = `
                                <td class="border px-6 py-4 whitespace-nowrap">${s.student_number || ''}</td>
                                <td class="border px-6 py-4 whitespace-nowrap">${s.student_name || ''}</td>
                                <td class="border px-6 py-4 whitespace-nowrap text-center">
                                    <input type="number" 
                                           name="scores[${s.id}]" 
                                           min="0" 
                                           max="${maxScore}" 
                                           value="${existingScore ? existingScore.score : ''}"
                                           class="w-24 px-3 py-2 border-2 border-gray-300 rounded-lg text-center focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-300 score-input" 
                                           placeholder="0"
                                           oninput="validateScore(this, ${maxScore})">
                                </td>
                            `;
                            scoresTableBody.appendChild(tr);
                        });
                    }
                });
            }

            // Score validation function
            window.validateScore = function (input, maxScore) {
                const value = parseInt(input.value);
                if (value > maxScore) {
                    input.classList.add('invalid');
                    input.classList.remove('valid');
                    input.setCustomValidity(`Score cannot exceed ${maxScore}`);
                } else if (value < 0) {
                    input.classList.add('invalid');
                    input.classList.remove('valid');
                    input.setCustomValidity('Score cannot be negative');
                } else {
                    input.classList.remove('invalid');
                    input.classList.add('valid');
                    input.setCustomValidity('');
                }
            }

            // ----------------- SCORES FORM SUBMISSION -----------------
            if (scoresForm) {
                scoresForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const assessmentId = scoreAssessmentSelect ? scoreAssessmentSelect.value : null;
                    if (!assessmentId) {
                        alert('Please select an assessment!');
                        return;
                    }

                    // Validate all scores
                    const scoreInputs = document.querySelectorAll('.score-input');
                    let isValid = true;
                    scoreInputs.forEach(input => {
                        if (input.classList.contains('invalid')) {
                            isValid = false;
                        }
                    });

                    if (!isValid) {
                        alert('Please fix invalid scores before saving.');
                        return;
                    }

                    const submitBtn = scoresForm.querySelector('button[type="submit"]');
                    const originalBtnText = submitBtn.innerHTML;

                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = `
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Saving...</span>
                `;
                    }

                    const formData = new FormData(scoresForm);
                    formData.append('assessment_id', assessmentId);

                    try {
                        const res = await axios.post("{{ route('scores.store') }}", formData);

                        // Show success message
                        showAlert('success', res.data.message || 'Scores saved successfully!');

                        // Show success toast
                        showToast('Scores saved successfully!');

                        // Refresh the students table to show updated scores
                        await window.loadStudents();

                        // Keep the modal open and refresh the scores table with the same assessment selected
                        if (scoreAssessmentSelect) {
                            // Trigger change event to reload the scores table with updated data
                            scoreAssessmentSelect.dispatchEvent(new Event('change'));
                        }

                    } catch (err) {
                        console.error('Error saving scores:', err);
                        showAlert('error', err.response?.data?.message || 'Error saving scores. Please try again.');
                    } finally {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalBtnText;
                        }
                    }
                });
            }

            // Also update the score validation function to be more user-friendly
            window.validateScore = function (input, maxScore) {
                const value = parseFloat(input.value);

                // Clear previous validation styles
                input.classList.remove('valid', 'invalid');

                if (isNaN(value) || input.value === '') {
                    // Empty input is allowed (will be treated as no score)
                    input.classList.add('valid');
                    input.setCustomValidity('');
                } else if (value > maxScore) {
                    input.classList.add('invalid');
                    input.setCustomValidity(`Score cannot exceed ${maxScore}`);

                    // Show tooltip-like message
                    showInputError(input, `Maximum score is ${maxScore}`);
                } else if (value < 0) {
                    input.classList.add('invalid');
                    input.setCustomValidity('Score cannot be negative');

                    // Show tooltip-like message
                    showInputError(input, 'Score cannot be negative');
                } else {
                    input.classList.add('valid');
                    input.setCustomValidity('');
                }
            }

            // Helper function to show input error
            function showInputError(input, message) {
                // Create or update error tooltip
                let errorTooltip = input.parentNode.querySelector('.input-error-tooltip');

                if (!errorTooltip) {
                    errorTooltip = document.createElement('div');
                    errorTooltip.className = 'input-error-tooltip absolute -top-8 left-0 bg-red-500 text-white text-xs px-2 py-1 rounded shadow-lg';
                    input.parentNode.style.position = 'relative';
                    input.parentNode.appendChild(errorTooltip);
                }

                errorTooltip.textContent = message;

                // Remove after 2 seconds
                setTimeout(() => {
                    if (errorTooltip && errorTooltip.parentNode) {
                        errorTooltip.remove();
                    }
                }, 2000);
            }

            // Add a "Refresh" button next to the assessment select to manually refresh scores
            function addRefreshButton() {
                const assessmentSelectContainer = document.querySelector('#scoreAssessmentSelect').parentNode;

                // Create refresh button if it doesn't exist
                if (!document.getElementById('refreshScoresBtn')) {
                    const refreshBtn = document.createElement('button');
                    refreshBtn.id = 'refreshScoresBtn';
                    refreshBtn.type = 'button';
                    refreshBtn.className = 'ml-2 px-3 py-2 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition-colors duration-200 flex items-center gap-1';
                    refreshBtn.innerHTML = `
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <span class="text-sm">Refresh</span>
            `;

                    refreshBtn.addEventListener('click', () => {
                        if (scoreAssessmentSelect) {
                            scoreAssessmentSelect.dispatchEvent(new Event('change'));
                            showToast('Scores refreshed!');
                        }
                    });

                    // Add to container
                    assessmentSelectContainer.style.display = 'flex';
                    assessmentSelectContainer.style.alignItems = 'center';
                    assessmentSelectContainer.appendChild(refreshBtn);
                }
            }

            // Call this function when scores modal opens
            if (openScoresModalBtn) {
                openScoresModalBtn.addEventListener('click', () => {
                    closeEditModal();
                    showModal(scoresModal);

                    // Add refresh button
                    setTimeout(addRefreshButton, 100);
                });
            }

            // ----------------- EXCEL UPLOAD AND PREVIEW -----------------
            if (excelFileInput) {
                excelFileInput.addEventListener('change', async (e) => {
                    const file = e.target.files[0];
                    if (!file) return;

                    hideModal(uploadModal);
                    showModal(previewModal);

                    const reader = new FileReader();
                    reader.onload = async evt => {
                        const data = new Uint8Array(evt.target.result);
                        const workbook = XLSX.read(data, { type: 'array' });
                        const sheet = workbook.Sheets[workbook.SheetNames[0]];
                        const rows = XLSX.utils.sheet_to_json(sheet, { header: 1, range: 3, defval: '' });

                        try {
                            const existingRes = await axios.get("{{ route('students.get') }}", {
                                params: { class_id: "{{ $classId }}" }
                            });
                            const existingNumbers = (existingRes.data.students || []).map(s => s.student_number);

                            if (previewTableBody) {
                                previewTableBody.innerHTML = '';
                            }

                            rows.forEach(row => {
                                const studentNumber = row[2] || '';
                                const rowClass = existingNumbers.includes(studentNumber) ? 'bg-red-100' : 'bg-green-100';

                                if (previewTableBody) {
                                    previewTableBody.innerHTML += `<tr class="hover:bg-gray-100 transition-colors duration-200 ${rowClass}">
                                        ${row.slice(1, 11).map(c => `<td class="border px-2 py-1">${c || ''}</td>`).join('')}
                                    </tr>`;
                                }
                            });

                            const base64Reader = new FileReader();
                            base64Reader.onload = evt => {
                                if (fileDataInput) {
                                    fileDataInput.value = evt.target.result.split(',')[1];
                                }
                            };
                            base64Reader.readAsDataURL(file);

                        } catch (err) {
                            console.error('Error reading existing students:', err);
                        }
                    };
                    reader.readAsArrayBuffer(file);
                });
            }

            if (saveForm) {
                saveForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const submitBtn = saveForm.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = `
                            <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Saving...</span>
                        `;
                    }

                    const formData = new FormData(saveForm);
                    if (!formData.get('class_id')) {
                        alert('Class ID missing!');
                        return;
                    }

                    try {
                        const res = await axios.post("{{ route('studentlist.import') }}", formData);

                        hideModal(previewModal);
                        showAlert('success', res.data.message || 'Students saved successfully!');

                        // Refresh the students table
                        setTimeout(() => {
                            window.loadStudents();
                        }, 500);

                    } catch (err) {
                        console.error('Error saving students:', err);
                        showAlert('error', 'Error saving students. Please try again.');
                    } finally {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = '💾 Save to Database';
                        }
                    }
                });
            }

            // ----------------- ESC KEY HANDLER -----------------
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    closeEditModal();

                    const dropdown = document.getElementById('gradingSheetDropdown');
                    if (dropdown && !dropdown.classList.contains('hidden')) {
                        dropdown.classList.add('hidden');
                        dropdown.classList.remove('show');
                        const arrow = document.getElementById('dropdownArrow');
                        if (arrow) arrow.classList.remove('rotate');
                    }

                    // Close any open modals
                    const modals = ['assessmentModal', 'criteriaModal', 'scoresModal', 'uploadModal', 'previewModal'];
                    modals.forEach(modalId => {
                        const modal = document.getElementById(modalId);
                        if (modal && !modal.classList.contains('hidden')) {
                            modal.classList.add('hidden');
                        }
                    });
                }
            });

            // ----------------- CLICK OUTSIDE MODAL HANDLER -----------------
            document.addEventListener('click', (e) => {
                const editModal = document.getElementById('editAssessmentModal');
                if (editModal && !editModal.classList.contains('hidden')) {
                    const modalContent = editModal.querySelector('.bg-white');
                    if (modalContent && !modalContent.contains(e.target)) {
                        closeEditModal();
                    }
                }
            });

            console.log('Initialization complete'); // Debug log
        });

        // Override loadStudents to reset search
        const originalLoadStudents = window.loadStudents;
        window.loadStudents = async function () {
            await originalLoadStudents();

            // Clear search after loading new data
            const searchInput = document.getElementById('studentSearch');
            if (searchInput) {
                searchInput.value = '';
            }

            // Reset search stats
            const searchStats = document.getElementById('searchStats');
            if (searchStats) {
                searchStats.classList.add('hidden');
            }

            // Update total count
            const rows = document.getElementById('studentTableBody')?.getElementsByTagName('tr') || [];
            const countDisplay = document.getElementById('studentCountDisplay');
            if (countDisplay) {
                // Filter out any no-results message row
                const validRows = Array.from(rows).filter(row => row.id !== 'noResultsMessage');
                countDisplay.textContent = `Total students: ${validRows.length}`;
            }

            // Remove any no results message
            const existingNoResults = document.getElementById('noResultsMessage');
            if (existingNoResults) {
                existingNoResults.remove();
            }
        };
    </script>

    <!-- Livewire Scripts - Add this before closing body tag -->
    @livewireScripts

    <!-- Add this to ensure Livewire works properly -->
    <script>
        // Refresh Livewire component when modal opens
        document.addEventListener('livewire:load', function () {
            console.log('Livewire loaded successfully!');

            // When criteria modal opens, refresh the Livewire component
            const openCriteriaModalBtn = document.getElementById('openCriteriaModal');
            const criteriaModal = document.getElementById('criteriaModal');

            if (openCriteriaModalBtn) {
                openCriteriaModalBtn.addEventListener('click', function () {
                    // Refresh Livewire component when modal opens
                    if (typeof Livewire !== 'undefined') {
                        Livewire.emit('refreshComponent');
                    }
                });
            }
        });
    </script>

@endsection