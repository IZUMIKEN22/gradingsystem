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
                <p class="text-gray-400">You have successfully logged in to the admin panel.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white/5 backdrop-blur-xl rounded-xl border border-white/10 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-indigo-600/20 rounded-lg">
                            <i class="fas fa-users text-indigo-400 text-xl"></i>
                        </div>
                        <span id="totalTeachers" class="text-2xl font-bold text-white">0</span>
                    </div>
                    <h3 class="text-gray-400 text-sm">Total Teachers</h3>
                </div>

                <div class="bg-white/5 backdrop-blur-xl rounded-xl border border-white/10 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-green-600/20 rounded-lg">
                            <i class="fas fa-user-check text-green-400 text-xl"></i>
                        </div>
                        <span id="activeTeachers" class="text-2xl font-bold text-white">0</span>
                    </div>
                    <h3 class="text-gray-400 text-sm">Active Teachers</h3>
                </div>

                <div class="bg-white/5 backdrop-blur-xl rounded-xl border border-white/10 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-purple-600/20 rounded-lg">
                            <i class="fas fa-chalkboard-teacher text-purple-400 text-xl"></i>
                        </div>
                        <span id="totalClasses" class="text-2xl font-bold text-white">0</span>
                    </div>
                    <h3 class="text-gray-400 text-sm">Total Classes</h3>
                </div>

                <div class="bg-white/5 backdrop-blur-xl rounded-xl border border-white/10 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-yellow-600/20 rounded-lg">
                            <i class="fas fa-user-graduate text-yellow-400 text-xl"></i>
                        </div>
                        <span id="totalStudents" class="text-2xl font-bold text-white">0</span>
                    </div>
                    <h3 class="text-gray-400 text-sm">Total Students</h3>
                </div>
            </div>

            <!-- Teachers List Section -->
            <div class="bg-white/5 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-white/10 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-white">Active Teachers</h3>
                        <p class="text-sm text-gray-400">List of all registered teachers</p>
                    </div>
                    <button onclick="refreshTeachers()"
                        class="px-3 py-1.5 bg-indigo-600/20 hover:bg-indigo-600/40 text-indigo-300 rounded-lg transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-sync-alt"></i>
                        <span>Refresh</span>
                    </button>
                </div>

                <!-- Loading Spinner -->
                <div id="loadingSpinner" class="text-center py-12">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-500"></div>
                    <p class="text-gray-400 mt-2">Loading teachers...</p>
                </div>

                <!-- Teachers Table -->
                <div id="teachersTableContainer" class="hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-white/5">
                            <thead class="bg-white/5">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Username</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Joined</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody id="teachersTableBody" class="divide-y divide-white/5">
                                <!-- Teachers will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- No Teachers Message -->
                <div id="noTeachersMessage" class="hidden text-center py-12">
                    <i class="fas fa-users text-5xl text-gray-600 mb-3"></i>
                    <p class="text-gray-400 text-lg">No teachers found</p>
                    <p class="text-gray-500 text-sm mt-1">Teachers will appear here once they register</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Check authentication
        (function () {
            const isAuthenticated = sessionStorage.getItem('admin_authenticated') === 'true';

            if (!isAuthenticated) {
                window.location.href = '/admin/login';
                return;
            }

            // Display admin email
            const adminEmail = sessionStorage.getItem('admin_email') || 'admin@admin.com';
            document.getElementById('adminEmail').textContent = adminEmail;
            document.getElementById('adminName').textContent = adminEmail.split('@')[0];

            // Load teachers data
            loadTeachers();
            loadStats();
        })();

        // Load teachers from API
        async function loadTeachers() {
            try {
                // Show loading, hide table and no message
                document.getElementById('loadingSpinner').classList.remove('hidden');
                document.getElementById('teachersTableContainer').classList.add('hidden');
                document.getElementById('noTeachersMessage').classList.add('hidden');

                // Fetch teachers from your API endpoint
                const response = await fetch('/api/admin/teachers', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch teachers');
                }

                const data = await response.json();

                // Hide loading spinner
                document.getElementById('loadingSpinner').classList.add('hidden');

                if (data.teachers && data.teachers.length > 0) {
                    // Show table and populate data
                    document.getElementById('teachersTableContainer').classList.remove('hidden');
                    renderTeachersTable(data.teachers);
                } else {
                    // Show no teachers message
                    document.getElementById('noTeachersMessage').classList.remove('hidden');
                }

            } catch (error) {
                console.error('Error loading teachers:', error);
                document.getElementById('loadingSpinner').classList.add('hidden');
                document.getElementById('noTeachersMessage').classList.remove('hidden');
                document.getElementById('noTeachersMessage').innerHTML = `
                    <i class="fas fa-exclamation-circle text-5xl text-red-500 mb-3"></i>
                    <p class="text-red-400 text-lg">Error loading teachers</p>
                    <p class="text-gray-500 text-sm mt-1">Please try refreshing the page</p>
                `;
            }
        }

        // Render teachers table
        function renderTeachersTable(teachers) {
            const tbody = document.getElementById('teachersTableBody');
            tbody.innerHTML = '';

            teachers.forEach(teacher => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-white/5 transition-colors';

                // Format date
                const joinedDate = teacher.created_at ? new Date(teacher.created_at).toLocaleDateString() : 'N/A';

                // Determine status badge color
                const statusBadge = teacher.is_active ?
                    '<span class="px-2 py-1 bg-green-600/20 text-green-400 rounded-full text-xs">Active</span>' :
                    '<span class="px-2 py-1 bg-gray-600/20 text-gray-400 rounded-full text-xs">Inactive</span>';

                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">${teacher.id || 'N/A'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">${teacher.name || 'N/A'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">${teacher.email || 'N/A'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">${teacher.username || 'N/A'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">${statusBadge}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">${joinedDate}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button onclick="viewTeacherDetails(${teacher.id})" class="text-indigo-400 hover:text-indigo-300 mr-3">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button onclick="toggleTeacherStatus(${teacher.id})" class="text-yellow-400 hover:text-yellow-300 mr-3">
                            <i class="fas fa-ban"></i>
                        </button>
                        <button onclick="deleteTeacher(${teacher.id})" class="text-red-400 hover:text-red-300">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;

                tbody.appendChild(row);
            });
        }

        // Load dashboard statistics
        async function loadStats() {
            try {
                const response = await fetch('/api/admin/stats', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const data = await response.json();

                    document.getElementById('totalTeachers').textContent = data.total_teachers || 0;
                    document.getElementById('activeTeachers').textContent = data.active_teachers || 0;
                    document.getElementById('totalClasses').textContent = data.total_classes || 0;
                    document.getElementById('totalStudents').textContent = data.total_students || 0;
                }
            } catch (error) {
                console.error('Error loading stats:', error);
            }
        }

        // Refresh teachers list
        function refreshTeachers() {
            loadTeachers();
            loadStats();
        }

        // View teacher details
        function viewTeacherDetails(teacherId) {
            window.location.href = `/admin/teachers/${teacherId}`;
        }

        // Toggle teacher status (activate/deactivate)
        async function toggleTeacherStatus(teacherId) {
            if (!confirm('Are you sure you want to change this teacher\'s status?')) {
                return;
            }

            try {
                const response = await fetch(`/api/admin/teachers/${teacherId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    // Reload teachers to show updated status
                    loadTeachers();
                    loadStats();
                } else {
                    alert('Failed to update teacher status');
                }
            } catch (error) {
                console.error('Error toggling status:', error);
                alert('Error updating teacher status');
            }
        }

        // Delete teacher
        async function deleteTeacher(teacherId) {
            if (!confirm('Are you sure you want to delete this teacher? This action cannot be undone.')) {
                return;
            }

            try {
                const response = await fetch(`/api/admin/teachers/${teacherId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    // Reload teachers
                    loadTeachers();
                    loadStats();
                } else {
                    alert('Failed to delete teacher');
                }
            } catch (error) {
                console.error('Error deleting teacher:', error);
                alert('Error deleting teacher');
            }
        }

        // Logout function
        function logout() {
            sessionStorage.removeItem('admin_authenticated');
            sessionStorage.removeItem('admin_email');
            window.location.href = '/admin/login';
        }
    </script>
@endsection