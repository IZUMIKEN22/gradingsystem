@extends('layout')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Admin Header -->
    <div class="bg-gradient-to-r from-indigo-900 to-purple-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-white/10 rounded-2xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Admin Dashboard</h1>
                        <p class="text-indigo-200 mt-1">Monitor and manage teachers across the system</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-indigo-200">{{ now()->format('l, F j, Y') }}</p>
                        <p class="text-xs text-indigo-300">{{ now()->format('h:i A') }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" 
                            class="px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg transition flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Teachers -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Teachers</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_teachers'] }}</p>
                    </div>
                    <div class="p-3 bg-indigo-100 rounded-xl">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-600 font-semibold">{{ $stats['active_teachers'] }}</span>
                    <span class="text-gray-500 ml-1">active now</span>
                </div>
            </div>

            <!-- Active Teachers -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Active Today</p>
                        <p class="text-3xl font-bold text-green-600">{{ $stats['active_teachers'] }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-xl">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" 
                             style="width: {{ $stats['total_teachers'] > 0 ? ($stats['active_teachers'] / $stats['total_teachers'] * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Total Classes -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Classes</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_classes'] }}</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-xl">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-sm text-gray-500">
                    Across {{ $stats['total_departments'] }} departments
                </p>
            </div>

            <!-- Current Academic Year -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Current Academic Year</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $stats['current_academic_year']->academic_year ?? 'Not Set' }}
                        </p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-xl">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-sm text-gray-500">
                    {{ $stats['total_academic_years'] }} total academic years
                </p>
            </div>
        </div>

        <!-- Teachers Table -->
        <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Teachers Monitoring</h2>
                        <p class="text-sm text-gray-600 mt-1">Real-time teacher activity and class assignments</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <input type="text" id="searchTeacher" placeholder="Search teachers..." 
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                            <option value="all">All Status</option>
                            <option value="active">Active</option>
                            <option value="away">Away</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Classes</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Active</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="teachersTableBody" class="bg-white divide-y divide-gray-200">
                        @foreach($teachers as $teacher)
                        <tr class="hover:bg-gray-50 transition teacher-row" data-status="{{ $teacher->status }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                                            {{ strtoupper(substr($teacher->name, 0, 2)) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $teacher->name }}</div>
                                        <div class="text-sm text-gray-500">ID: {{ $teacher->teacher_id ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $teacher->email }}</div>
                                <div class="text-sm text-gray-500">{{ $teacher->contact_number ?? 'No contact' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($teacher->status == 'active')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5 mt-1"></span>
                                        Active Now
                                    </span>
                                @elseif($teacher->status == 'away')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <span class="w-2 h-2 bg-yellow-500 rounded-full mr-1.5 mt-1"></span>
                                        Away
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        <span class="w-2 h-2 bg-gray-500 rounded-full mr-1.5 mt-1"></span>
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $teacher->total_classes }} Total</div>
                                <div class="text-sm text-gray-500">{{ $teacher->active_classes }} Active</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $teacher->last_active }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="viewTeacherDetails({{ $teacher->id }})" 
                                    class="text-indigo-600 hover:text-indigo-900 mr-3">View</button>
                                <button onclick="toggleTeacherStatus({{ $teacher->id }})" 
                                    class="text-yellow-600 hover:text-yellow-900">Status</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <span>Showing <span id="visibleCount">{{ $teachers->count() }}</span> of <span id="totalCount">{{ $teachers->count() }}</span> teachers</span>
                    <div class="flex items-center space-x-4">
                        <span class="flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span> Active
                        </span>
                        <span class="flex items-center">
                            <span class="w-2 h-2 bg-yellow-500 rounded-full mr-1"></span> Away
                        </span>
                        <span class="flex items-center">
                            <span class="w-2 h-2 bg-gray-500 rounded-full mr-1"></span> Inactive
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Teacher Details Modal -->
<div id="teacherModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white flex justify-between items-center">
            <h3 class="text-xl font-semibold" id="modalTitle">Teacher Details</h3>
            <button onclick="closeModal()" class="hover:bg-white/20 rounded-lg p-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-[calc(90vh-80px)]" id="modalContent">
            <!-- Content will be loaded dynamically -->
        </div>
    </div>
</div>

<script>
// Search and filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchTeacher');
    const statusFilter = document.getElementById('statusFilter');
    const rows = document.querySelectorAll('.teacher-row');
    const visibleCountSpan = document.getElementById('visibleCount');

    function filterTeachers() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        let visibleCount = 0;

        rows.forEach(row => {
            const teacherName = row.querySelector('.text-gray-900').textContent.toLowerCase();
            const teacherEmail = row.querySelector('.text-gray-900 + .text-gray-500').textContent.toLowerCase();
            const status = row.dataset.status;
            
            const matchesSearch = teacherName.includes(searchTerm) || teacherEmail.includes(searchTerm);
            const matchesStatus = statusValue === 'all' || status === statusValue;
            
            if (matchesSearch && matchesStatus) {
                row.classList.remove('hidden');
                visibleCount++;
            } else {
                row.classList.add('hidden');
            }
        });

        visibleCountSpan.textContent = visibleCount;
    }

    searchInput.addEventListener('input', filterTeachers);
    statusFilter.addEventListener('change', filterTeachers);
});

// View teacher details
function viewTeacherDetails(teacherId) {
    fetch(`/admin/teachers/${teacherId}`)
        .then(response => response.json())
        .then(data => {
            const modal = document.getElementById('teacherModal');
            const modalContent = document.getElementById('modalContent');
            
            let classesHtml = '';
            if (data.teacher.classes && data.teacher.classes.length > 0) {
                classesHtml = data.teacher.classes.map(cls => `
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-semibold text-gray-900">${cls.subject_code} - ${cls.subject_description}</h4>
                                <p class="text-sm text-gray-600 mt-1">${cls.department?.name} • Block ${cls.block?.name} • Section ${cls.section}</p>
                                <p class="text-xs text-gray-500 mt-2">${cls.schedule_date} • ${cls.schedule_time}</p>
                            </div>
                            <span class="px-2 py-1 text-xs bg-indigo-100 text-indigo-800 rounded-full">${cls.academic_year?.academic_year}</span>
                        </div>
                    </div>
                `).join('');
            } else {
                classesHtml = '<p class="text-gray-500 text-center py-4">No classes assigned yet</p>';
            }

            modalContent.innerHTML = `
                <div class="space-y-6">
                    <!-- Teacher Info -->
                    <div class="flex items-center space-x-4">
                        <div class="h-16 w-16 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xl font-bold">
                            ${data.teacher.name.charAt(0)}
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">${data.teacher.name}</h2>
                            <p class="text-gray-600">${data.teacher.email}</p>
                            <p class="text-sm text-gray-500">${data.teacher.contact_number || 'No contact number'}</p>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-indigo-50 rounded-xl p-4 text-center">
                            <p class="text-2xl font-bold text-indigo-600">${data.stats.total}</p>
                            <p class="text-sm text-gray-600">Total Classes</p>
                        </div>
                        <div class="bg-green-50 rounded-xl p-4 text-center">
                            <p class="text-2xl font-bold text-green-600">${data.teacher.active_classes}</p>
                            <p class="text-sm text-gray-600">Active Classes</p>
                        </div>
                        <div class="bg-purple-50 rounded-xl p-4 text-center">
                            <p class="text-2xl font-bold text-purple-600">${Object.keys(data.stats.by_academic_year).length}</p>
                            <p class="text-sm text-gray-600">Academic Years</p>
                        </div>
                    </div>

                    <!-- Classes List -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Assigned Classes</h3>
                        <div class="space-y-3">
                            ${classesHtml}
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('modalTitle').textContent = `Teacher Details - ${data.teacher.name}`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
}

function closeModal() {
    const modal = document.getElementById('teacherModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function toggleTeacherStatus(teacherId) {
    // Implement status toggle functionality
    alert('Status toggle functionality - In development');
}

// Close modal when clicking outside
document.getElementById('teacherModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>

<style>
.teacher-row.hidden {
    display: none;
}
</style>
@endsection