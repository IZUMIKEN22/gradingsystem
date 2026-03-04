@extends('layout')

@section('title', 'Settings - Grading System')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Page Header with Gradient -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text">Settings</h1>
                            <p class="text-gray-500 mt-1">Manage your profile and system configurations</p>
                        </div>
                    </div>
                    <div class="hidden sm:block">
                        <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                            System Active
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Alerts -->
        @if (session('success'))
            <div class="mb-6 transform transition-all duration-500 animate-slideDown">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl shadow-lg p-4 flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="flex-shrink-0 ml-auto">
                        <svg class="w-5 h-5 text-white hover:text-green-100" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 transform transition-all duration-500 animate-slideDown">
                <div class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl shadow-lg p-4 flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="flex-shrink-0 ml-auto">
                        <svg class="w-5 h-5 text-white hover:text-red-100" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Profile Card - Left Column (Redesigned) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden sticky top-24 transform transition-all duration-300 hover:shadow-2xl">
                    <!-- Profile Header with Gradient -->
                    <div class="h-32 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 relative">
                        <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                            <div class="relative group">
                                <div class="w-28 h-28 rounded-full bg-gradient-to-br from-indigo-600 to-purple-700 flex items-center justify-center shadow-xl ring-4 ring-white transform transition-all duration-300 group-hover:scale-105">
                                    <span class="text-white text-4xl font-bold">{{ substr($teacher->name, 0, 1) }}</span>
                                </div>
                                <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 rounded-full border-4 border-white animate-pulse"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Profile Info -->
                    <div class="pt-16 pb-8 px-6 text-center">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $teacher->name }}</h2>
                        <p class="text-gray-500 flex items-center justify-center mt-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            {{ $teacher->email }}
                        </p>
                        
                        <!-- Badges -->
                        <div class="flex flex-wrap gap-2 justify-center mt-4">
                            <span class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-full text-sm font-semibold flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Teacher
                            </span>
                            <span class="px-4 py-2 bg-green-50 text-green-600 rounded-full text-sm font-semibold flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                Active
                            </span>
                        </div>
                    </div>
                    
                    <!-- Quick Stats with Icons -->
                    <div class="border-t border-gray-100 bg-gray-50 px-6 py-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="flex items-center justify-center mb-2">
                                    <div class="p-2 bg-indigo-100 rounded-lg">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                </div>
                                <span class="block text-2xl font-bold text-gray-900">{{ $departments->count() }}</span>
                                <span class="text-sm text-gray-500">Departments</span>
                            </div>
                            <div class="text-center">
                                <div class="flex items-center justify-center mb-2">
                                    <div class="p-2 bg-purple-100 rounded-lg">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                        </svg>
                                    </div>
                                </div>
                                <span class="block text-2xl font-bold text-gray-900">{{ $departments->sum(function($dept) { return $dept->blocks->count(); }) }}</span>
                                <span class="text-sm text-gray-500">Total Blocks</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Enhanced Tabs -->
            <div class="lg:col-span-2">
                <!-- Modern Tabs Navigation -->
                <div class="bg-white rounded-t-2xl shadow-lg border border-gray-100 border-b-0">
                    <div class="px-6">
                        <nav class="flex space-x-8" aria-label="Tabs">
                            <button onclick="showTab('profile')" id="tab-profile-btn" 
                                    class="tab-button py-5 px-1 border-b-2 font-medium text-sm transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Profile Settings</span>
                            </button>
                            <button onclick="showTab('departments')" id="tab-departments-btn" 
                                    class="tab-button py-5 px-1 border-b-2 font-medium text-sm transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span>Departments</span>
                            </button>
                            <button onclick="showTab('blocks')" id="tab-blocks-btn" 
                                    class="tab-button py-5 px-1 border-b-2 font-medium text-sm transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                                <span>Blocks</span>
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Tab Contents with Enhanced Cards -->
                <div class="bg-white rounded-b-2xl shadow-xl border border-gray-100 border-t-0 p-6">
                    <!-- Profile Tab (Enhanced Form) -->
                    <div id="profile-tab" class="tab-content">
                        <form method="POST" action="{{ route('settings.profile.update') }}" class="space-y-8">
                            @csrf
                            @method('PUT')

                            <!-- Profile Information Section -->
                            <div class="space-y-6">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-indigo-100 rounded-lg">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900">Profile Information</h3>
                                </div>

                                <div class="grid gap-6 md:grid-cols-2">
                                    <div class="col-span-2 md:col-span-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <input type="text" name="name" value="{{ old('name', $teacher->name) }}" required
                                                   class="w-full pl-10 rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 hover:border-indigo-300">
                                        </div>
                                    </div>

                                    <div class="col-span-2 md:col-span-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <input type="email" name="email" value="{{ old('email', $teacher->email) }}" required
                                                   class="w-full pl-10 rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 hover:border-indigo-300">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Change Section -->
                            <div class="space-y-6 pt-6 border-t border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-yellow-100 rounded-lg">
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Change Password</h3>
                                        <p class="text-sm text-gray-500">Leave blank if you don't want to change your password</p>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                            </div>
                                            <input type="password" name="current_password"
                                                   class="w-full pl-10 rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                                        </div>
                                    </div>

                                    <div class="grid gap-4 md:grid-cols-2">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                            <input type="password" name="new_password"
                                                   class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                                            <input type="password" name="new_password_confirmation"
                                                   class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex justify-end pt-6">
                                <button type="submit"
                                        class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-xl font-semibold hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                        <svg class="h-5 w-5 text-indigo-300 group-hover:text-indigo-200 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </span>
                                    <span class="ml-6">Update Profile</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Departments Tab (Enhanced) -->
                    <div id="departments-tab" class="tab-content hidden">
                        <div class="space-y-6">
                            <!-- Header with Actions -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-indigo-100 rounded-lg">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900">Manage Departments</h3>
                                </div>
                                
                                <div class="flex gap-3">
                                    @if($departments->count() > 0)
                                    <button onclick="confirmDeleteAllDepartments()"
                                            class="group relative inline-flex items-center px-4 py-2.5 bg-red-600 text-white rounded-xl font-medium hover:bg-red-700 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete All
                                    </button>
                                    @endif
                                    
                                    <button onclick="openDepartmentModal()"
                                            class="group relative inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl font-medium hover:from-green-700 hover:to-green-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Department
                                    </button>
                                </div>
                            </div>

                            <!-- Departments Grid -->
                            <div class="grid gap-4 md:grid-cols-2">
                                @forelse($departments as $department)
                                    <div class="group relative bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 hover:border-indigo-300 transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
                                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                                        <div class="p-5">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <h4 class="font-semibold text-gray-900 text-lg mb-1">{{ $department->name }}</h4>
                                                    @if($department->head)
                                                        <p class="text-sm text-gray-600 flex items-center">
                                                            <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                            </svg>
                                                            {{ $department->head }}
                                                        </p>
                                                    @endif
                                                    <div class="mt-2 flex items-center text-xs text-gray-500">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                                        </svg>
                                                        {{ $department->blocks->count() }} blocks
                                                    </div>
                                                </div>
                                                <div class="flex gap-1 ml-4">
                                                    <button onclick="editDepartment({{ $department->id }}, '{{ $department->name }}', '{{ $department->head }}')"
                                                            class="p-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-all duration-200 transform hover:scale-110">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </button>
                                                    <form action="{{ route('settings.departments.destroy', $department->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this department?')"
                                                                class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200 transform hover:scale-110">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-2 text-center py-12">
                                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-medium text-gray-900 mb-2">No Departments Yet</h4>
                                        <p class="text-gray-500 mb-4">Get started by creating your first department</p>
                                        <button onclick="openDepartmentModal()"
                                                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Add Department
                                        </button>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Blocks Tab (Enhanced) -->
                    <div id="blocks-tab" class="tab-content hidden">
                        <div class="space-y-6">
                            <!-- Header with Actions -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-purple-100 rounded-lg">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900">Manage Blocks</h3>
                                </div>
                                
                                <div class="flex gap-3">
                                    @if($departments->sum(function($dept) { return $dept->blocks->count(); }) > 0)
                                    <button onclick="confirmDeleteAllBlocks()"
                                            class="group relative inline-flex items-center px-4 py-2.5 bg-red-600 text-white rounded-xl font-medium hover:bg-red-700 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete All
                                    </button>
                                    @endif
                                    
                                    <button onclick="openBlockModal()"
                                            class="group relative inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl font-medium hover:from-green-700 hover:to-green-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Block
                                    </button>
                                </div>
                            </div>

                            <!-- Blocks Grid -->
                            <div class="grid gap-4 md:grid-cols-2">
                                @forelse($departments as $department)
                                    @foreach($department->blocks as $block)
                                        <div class="group relative bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 hover:border-purple-300 transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
                                            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                                            <div class="p-5">
                                                <div class="flex items-start justify-between">
                                                    <div class="flex-1">
                                                        <h4 class="font-semibold text-gray-900 text-lg mb-1">{{ $block->name }}</h4>
                                                        <p class="text-sm text-gray-600 flex items-center">
                                                            <svg class="w-4 h-4 mr-1 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                            </svg>
                                                            {{ $department->name }}
                                                        </p>
                                                    </div>
                                                    <div class="flex gap-1 ml-4">
                                                        <button onclick="editBlock({{ $block->id }}, {{ $block->department_id }}, '{{ $block->name }}')"
                                                                class="p-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-all duration-200 transform hover:scale-110">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </button>
                                                        <form action="{{ route('settings.blocks.destroy', $block->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this block?')"
                                                                    class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200 transform hover:scale-110">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @empty
                                    <div class="col-span-2 text-center py-12">
                                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-medium text-gray-900 mb-2">No Blocks Yet</h4>
                                        <p class="text-gray-500 mb-4">Create your first block to get started</p>
                                        <button onclick="openBlockModal()"
                                                class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Add Block
                                        </button>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Modals -->
    <!-- Add/Edit Department Modal -->
    <div id="departmentModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6 transform transition-all duration-300 scale-95 hover:scale-100">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-indigo-100 rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 id="departmentModalTitle" class="text-xl font-bold text-gray-900">Add Department</h3>
                </div>
                <button onclick="closeDepartmentModal()" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <form id="departmentForm" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" id="departmentMethod" value="POST">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Department Name</label>
                        <input type="text" name="name" id="departmentName" required
                               class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                               placeholder="e.g., College of Engineering">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Department Head</label>
                        <input type="text" name="head" id="departmentHead"
                               class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                               placeholder="e.g., Dr. Juan Dela Cruz">
                        <p class="mt-1 text-xs text-gray-500">Optional</p>
                    </div>
                </div>
                
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeDepartmentModal()"
                            class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-xl font-medium hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 transform hover:scale-105 shadow-lg">
                        Save Department
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add/Edit Block Modal -->
    <div id="blockModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6 transform transition-all duration-300 scale-95 hover:scale-100">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </div>
                    <h3 id="blockModalTitle" class="text-xl font-bold text-gray-900">Add Block</h3>
                </div>
                <button onclick="closeBlockModal()" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <form id="blockForm" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" id="blockMethod" value="POST">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                        <select name="department_id" id="blockDepartment" required
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Block Name</label>
                        <input type="text" name="name" id="blockName" required
                               class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                               placeholder="e.g., Block 1A">
                    </div>
                </div>
                
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeBlockModal()"
                            class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-xl font-medium hover:from-purple-700 hover:to-purple-800 transition-all duration-200 transform hover:scale-105 shadow-lg">
                        Save Block
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete All Departments Confirmation Modal -->
    <div id="deleteAllDepartmentsModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6 transform transition-all duration-300 scale-95 hover:scale-100">
            <div class="text-center">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-red-100 flex items-center justify-center animate-pulse">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Delete All Departments?</h3>
                <p class="text-gray-600 mb-6">This will permanently delete all departments and their associated blocks. This action cannot be undone.</p>
                
                <form id="deleteAllDepartmentsForm" method="POST" action="/settings/departments/delete-all">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" onclick="closeDeleteAllDepartmentsModal()"
                                class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-xl font-medium hover:from-red-700 hover:to-red-800 transition-all duration-200 transform hover:scale-105 shadow-lg">
                            Delete All
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete All Blocks Confirmation Modal -->
    <div id="deleteAllBlocksModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6 transform transition-all duration-300 scale-95 hover:scale-100">
            <div class="text-center">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-red-100 flex items-center justify-center animate-pulse">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Delete All Blocks?</h3>
                <p class="text-gray-600 mb-6">This will permanently delete all blocks across all departments. This action cannot be undone.</p>
                
                <form id="deleteAllBlocksForm" method="POST" action="/settings/blocks/delete-all">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" onclick="closeDeleteAllBlocksModal()"
                                class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-xl font-medium hover:from-red-700 hover:to-red-800 transition-all duration-200 transform hover:scale-105 shadow-lg">
                            Delete All
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript -->
<script>
    // Tab functionality with persistence
    function showTab(tabName, updateStorage = true) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Show selected tab
        document.getElementById(tabName + '-tab').classList.remove('hidden');
        
        // Update tab buttons
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('border-indigo-600', 'text-indigo-600');
            btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        });
        
        // Activate clicked button
        const activeBtn = document.getElementById('tab-' + tabName + '-btn');
        activeBtn.classList.add('border-indigo-600', 'text-indigo-600');
        activeBtn.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        
        // Save to localStorage
        if (updateStorage) {
            localStorage.setItem('settingsActiveTab', tabName);
        }
        
        // Update URL hash without scrolling
        history.replaceState(null, null, '#' + tabName);
    }

    // Load saved tab on page load
    function loadSavedTab() {
        // Check URL hash first
        const hash = window.location.hash.substring(1);
        if (hash && ['profile', 'departments', 'blocks'].includes(hash)) {
            showTab(hash, true);
            return;
        }
        
        // Then check localStorage
        const savedTab = localStorage.getItem('settingsActiveTab');
        if (savedTab && ['profile', 'departments', 'blocks'].includes(savedTab)) {
            showTab(savedTab, false);
        } else {
            // Default to profile tab
            showTab('profile', false);
        }
    }

    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('[class*="bg-gradient-to-r"]');
            alerts.forEach(alert => {
                if (alert.classList.contains('from-green-500') || alert.classList.contains('from-red-500')) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            });
        }, 5000);
    });

    // Department Modal Functions
    function openDepartmentModal() {
        document.getElementById('departmentModalTitle').textContent = 'Add Department';
        document.getElementById('departmentForm').action = '{{ route("settings.departments.store") }}';
        document.getElementById('departmentMethod').value = 'POST';
        document.getElementById('departmentName').value = '';
        document.getElementById('departmentHead').value = '';
        document.getElementById('departmentModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function editDepartment(id, name, head) {
        document.getElementById('departmentModalTitle').textContent = 'Edit Department';
        document.getElementById('departmentForm').action = '/settings/departments/' + id;
        document.getElementById('departmentMethod').value = 'PUT';
        document.getElementById('departmentName').value = name;
        document.getElementById('departmentHead').value = head || '';
        document.getElementById('departmentModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeDepartmentModal() {
        document.getElementById('departmentModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Block Modal Functions
    function openBlockModal() {
        document.getElementById('blockModalTitle').textContent = 'Add Block';
        document.getElementById('blockForm').action = '{{ route("settings.blocks.store") }}';
        document.getElementById('blockMethod').value = 'POST';
        document.getElementById('blockDepartment').value = '';
        document.getElementById('blockName').value = '';
        document.getElementById('blockModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function editBlock(id, departmentId, name) {
        document.getElementById('blockModalTitle').textContent = 'Edit Block';
        document.getElementById('blockForm').action = '/settings/blocks/' + id;
        document.getElementById('blockMethod').value = 'PUT';
        document.getElementById('blockDepartment').value = departmentId;
        document.getElementById('blockName').value = name;
        document.getElementById('blockModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeBlockModal() {
        document.getElementById('blockModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Delete All Functions
    function confirmDeleteAllDepartments() {
        document.getElementById('deleteAllDepartmentsModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteAllDepartmentsModal() {
        document.getElementById('deleteAllDepartmentsModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function confirmDeleteAllBlocks() {
        document.getElementById('deleteAllBlocksModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteAllBlocksModal() {
        document.getElementById('deleteAllBlocksModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        const modals = ['departmentModal', 'blockModal', 'deleteAllDepartmentsModal', 'deleteAllBlocksModal'];
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (event.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    }

    // Initialize tabs on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadSavedTab();
        
        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });

    // Listen for hash changes
    window.addEventListener('hashchange', function() {
        const hash = window.location.hash.substring(1);
        if (hash && ['profile', 'departments', 'blocks'].includes(hash)) {
            showTab(hash, true);
        }
    });

    // Keyboard support - ESC to close modals
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modals = ['departmentModal', 'blockModal', 'deleteAllDepartmentsModal', 'deleteAllBlocksModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal.style.display === 'flex') {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        }
    });
</script>

<!-- Enhanced Custom Styles -->
<style>
    /* Tab Styles */
    .tab-button {
        position: relative;
        overflow: hidden;
    }
    
    .tab-button::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(to right, #4f46e5, #7c3aed);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .tab-button.border-indigo-600::after {
        transform: scaleX(1);
    }
    
    /* Modal Animations */
    #departmentModal, #blockModal, #deleteAllDepartmentsModal, #deleteAllBlocksModal {
        animation: fadeIn 0.3s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            backdrop-filter: blur(0);
        }
        to {
            opacity: 1;
            backdrop-filter: blur(8px);
        }
    }
    
    /* Slide Down Animation for Alerts */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-slideDown {
        animation: slideDown 0.5s ease-out;
    }
    
    /* Pulse Animation for Status */
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }
    
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    /* Hover Effects */
    .hover\:scale-105:hover {
        transform: scale(1.05);
    }
    
    .hover\:shadow-xl:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    /* Gradient Text */
    .bg-gradient-to-r {
        background-size: 200% auto;
        transition: background-position 0.3s ease;
    }
    
    .bg-gradient-to-r:hover {
        background-position: right center;
    }
    
    /* Form Input Focus Effects */
    input:focus, select:focus, textarea:focus {
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    /* Card Hover Effects */
    .group:hover .group-hover\:opacity-10 {
        opacity: 0.1;
    }
    
    /* Scrollbar Styling */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #4f46e5, #7c3aed);
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #4338ca, #6d28d9);
    }
</style>
@endsection