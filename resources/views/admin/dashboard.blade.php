@extends('layout')

@section('title', 'Admin Dashboard - Grading System')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-slate-900 to-black">
    <!-- Navigation -->
    <nav class="bg-white/10 backdrop-blur-xl border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-shield-alt text-indigo-400 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-xl font-bold text-white">Admin Dashboard</h1>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span id="adminEmail" class="text-sm text-gray-300"></span>
                    <button onclick="logout()" 
                        class="px-4 py-2 bg-red-600/20 hover:bg-red-600/40 text-red-300 rounded-lg transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="bg-white/5 backdrop-blur-xl rounded-2xl border border-white/10 p-8 mb-8">
            <h2 class="text-2xl font-bold text-white mb-2">Welcome back, <span id="adminName">Administrator</span>!</h2>
            <p class="text-gray-400">You have successfully logged in to the admin panel using JavaScript verification.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white/5 backdrop-blur-xl rounded-xl border border-white/10 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-indigo-600/20 rounded-lg">
                        <i class="fas fa-users text-indigo-400 text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-white">5</span>
                </div>
                <h3 class="text-gray-400 text-sm">Total Teachers</h3>
            </div>

            <div class="bg-white/5 backdrop-blur-xl rounded-xl border border-white/10 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-600/20 rounded-lg">
                        <i class="fas fa-chalkboard-teacher text-purple-400 text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-white">8</span>
                </div>
                <h3 class="text-gray-400 text-sm">Total Classes</h3>
            </div>

            <div class="bg-white/5 backdrop-blur-xl rounded-xl border border-white/10 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-600/20 rounded-lg">
                        <i class="fas fa-user-graduate text-green-400 text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-white">120</span>
                </div>
                <h3 class="text-gray-400 text-sm">Total Students</h3>
            </div>

            <div class="bg-white/5 backdrop-blur-xl rounded-xl border border-white/10 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-yellow-600/20 rounded-lg">
                        <i class="fas fa-file-pdf text-yellow-400 text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-white">15</span>
                </div>
                <h3 class="text-gray-400 text-sm">Generated Reports</h3>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/5 backdrop-blur-xl rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-all duration-300 group cursor-pointer">
                <i class="fas fa-user-plus text-indigo-400 text-2xl mb-3 group-hover:scale-110 transition-transform"></i>
                <h3 class="text-white font-semibold mb-2">Manage Teachers</h3>
                <p class="text-gray-400 text-sm">Add, edit, or remove teacher accounts</p>
            </div>

            <div class="bg-white/5 backdrop-blur-xl rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-all duration-300 group cursor-pointer">
                <i class="fas fa-chart-line text-purple-400 text-2xl mb-3 group-hover:scale-110 transition-transform"></i>
                <h3 class="text-white font-semibold mb-2">View Reports</h3>
                <p class="text-gray-400 text-sm">Access system-wide analytics and reports</p>
            </div>

            <div class="bg-white/5 backdrop-blur-xl rounded-xl border border-white/10 p-6 hover:bg-white/10 transition-all duration-300 group cursor-pointer">
                <i class="fas fa-cog text-green-400 text-2xl mb-3 group-hover:scale-110 transition-transform"></i>
                <h3 class="text-white font-semibold mb-2">System Settings</h3>
                <p class="text-gray-400 text-sm">Configure application settings</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Check authentication before showing dashboard
    (function() {
        const isAuthenticated = sessionStorage.getItem('admin_authenticated') === 'true' || 
                                document.cookie.includes('admin_authenticated=true');
        
        if (!isAuthenticated) {
            window.location.href = '/admin/login';
        }
    })();
</script>
@endsection