<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Grading System')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        /* Modern scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: linear-gradient(to bottom, #f8fafc, #f1f5f9);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #818cf8, #6366f1);
            border-radius: 10px;
            border: 2px solid #f1f5f9;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #6366f1, #4f46e5);
        }

        /* Smooth transitions */
        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .animate-slide-down {
            animation: slideDown 0.5s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.5s ease-out;
        }

        .animate-slide-left {
            animation: slideInLeft 0.5s ease-out;
        }

        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .glass-dark {
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Button hover effects */
        .btn-hover {
            position: relative;
            overflow: hidden;
        }

        .btn-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-hover:hover::before {
            left: 100%;
        }

        /* Card shadow */
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06),
                0 0 0 1px rgba(0, 0, 0, 0.05);
        }

        .card-shadow:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Side navigation active link */
        .nav-link-active {
            background: linear-gradient(90deg, rgba(79, 70, 229, 0.1) 0%, rgba(79, 70, 229, 0.05) 100%);
            border-left: 4px solid #4f46e5;
            color: #4f46e5;
        }

        .nav-link-active i {
            color: #4f46e5;
        }

        /* Sticky header styles */
        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 50;
            transition: box-shadow 0.3s ease;
        }

        .sticky-header.scrolled {
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.2);
        }

        /* Mobile menu overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 40;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Side nav positioning - FIXED */
        .side-nav {
            position: fixed;
            top: 5rem;
            /* Height of header */
            left: 0;
            height: calc(100vh - 5rem);
            z-index: 45;
            overflow-y: auto;
            width: 18rem;
            /* w-72 */
        }

        /* Desktop layout */
        @media (min-width: 1024px) {
            body.has-sidebar .main-content {
                margin-left: 18rem;
            }

            /* Reset fixed positioning on desktop */
            .side-nav {
                position: fixed;
            }
        }

        /* Main wrapper for layout */
        .app-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            position: relative;
        }

        /* Main content area */
        .main-content {
            flex: 1;
            padding: 1.5rem 1rem;
            width: 100%;
        }

        @media (min-width: 640px) {
            .main-content {
                padding: 1.5rem 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .main-content {
                padding: 1.5rem 2rem;
            }
        }
    </style>

     @livewireStyles
    @stack('styles')
</head>

<body
    class="min-h-full antialiased @if(!Request::is('login') && !Request::is('register') && session()->has('teacher_id')) has-sidebar @endif @if(!Request::is('login') && !Request::is('register')) bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 @endif">

    <!-- Mobile Menu Overlay -->
    <div class="overlay" id="menuOverlay" onclick="toggleSideMenu()"></div>

    @if(!Request::is('login') && !Request::is('register'))
        <div class="app-wrapper">
            <!-- Header -->
            <header id="mainHeader" class="sticky-header glass border-b border-white/20 shadow-lg animate-slide-down">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-20">
                        <!-- Left Section: Menu Toggle + Logo -->
                        <div class="flex items-center space-x-4">
                            <!-- Mobile Menu Toggle Button -->
                            @if(session()->has('teacher_id'))
                                <button onclick="toggleSideMenu()" class="lg:hidden p-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white 
                                                                       shadow-lg shadow-blue-500/30 hover:shadow-xl transform hover:scale-105 
                                                                       transition-all duration-300">
                                    <i class="fas fa-bars text-lg"></i>
                                </button>
                            @endif

                            <!-- Logo Section -->
                            <div class="flex items-center space-x-4">
                                <div class="relative group">
                                    <div
                                        class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-300">
                                    </div>
                                    <div
                                        class="relative w-14 h-14 flex items-center justify-center rounded-2xl 
                                                            bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600
                                                            text-white font-bold shadow-lg transform group-hover:scale-105 transition-transform duration-300">
                                        <i class="fas fa-graduation-cap text-xl"></i>
                                    </div>
                                </div>

                                <div class="hidden md:block">
                                    <h2
                                        class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                        GradingSystem Pro
                                    </h2>
                                    <p class="text-sm text-gray-600 flex items-center gap-1">
                                        <i class="fas fa-shield-alt text-green-500 text-xs"></i>
                                        Teacher Management Portal
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Section -->
                        <div class="flex items-center space-x-4">
                            @if(session()->has('teacher_id'))
                                <!-- User Profile Card -->
                                <div
                                    class="flex items-center gap-3 px-4 py-2 bg-gradient-to-r from-slate-50 to-gray-50 rounded-xl border border-gray-200 card-shadow">
                                    <div class="relative">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center ring-2 ring-white">
                                            <span
                                                class="text-white text-sm font-bold">{{ substr(session('teacher_name', 'T'), 0, 1) }}</span>
                                        </div>
                                        <div
                                            class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white">
                                        </div>
                                    </div>
                                    <div class="hidden md:block text-left">
                                        <p class="text-sm font-bold text-gray-800">{{ session('teacher_name', 'Teacher') }}</p>
                                        <p class="text-xs text-gray-500 flex items-center gap-1">
                                            <i class="fas fa-id-card text-blue-500"></i>
                                            ID: {{ session('teacher_id') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Logout Button -->
                                <form method="POST" action="/logout" id="logoutForm" class="inline">
                                    @csrf
                                    <button type="button" onclick="confirmLogout()"
                                        class="btn-hover px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-semibold
                                                                               shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40
                                                                               transform hover:scale-105 active:scale-95
                                                                               transition-all duration-300 flex items-center gap-2">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span class="hidden sm:inline">Logout</span>
                                    </button>
                                </form>
                            @else
                                <!-- Login Button for non-authenticated users -->
                                <a href="/login" class="btn-hover px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-semibold
                                                                       shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40
                                                                       transform hover:scale-105 active:scale-95
                                                                       transition-all duration-300 flex items-center gap-2">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Login</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Wrapper with Sidebar -->
            <div class="content-wrapper">
                @if(session()->has('teacher_id'))
                    <!-- Side Navigation -->
                    <aside id="sideNav"
                        class="side-nav bg-gradient-to-b from-white to-slate-50 border-r border-white/20
                                                                  shadow-2xl lg:shadow-xl transform -translate-x-full lg:translate-x-0
                                                                  transition-transform duration-300 ease-in-out overflow-y-auto">

                        <!-- User Profile Summary in Sidebar -->
                        <div class="p-6 border-b border-gray-200/80 bg-gradient-to-r from-blue-50/50 to-indigo-50/50">
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    <div
                                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 flex items-center justify-center shadow-xl">
                                        <span
                                            class="text-white text-2xl font-bold">{{ substr(session('teacher_name', 'T'), 0, 1) }}</span>
                                    </div>
                                    <div
                                        class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-3 border-white">
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">{{ session('teacher_name', 'Teacher Name') }}</h3>
                                    <p class="text-sm text-gray-600 flex items-center gap-1 mt-1">
                                        <i class="fas fa-envelope text-blue-500 text-xs"></i>
                                        {{ session('email', 'teacher@school.edu') }}
                                    </p>
                                    <span
                                        class="inline-flex items-center gap-1 mt-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-circle text-[8px]"></i>
                                        Online
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Menu -->
                        <nav class="p-4 space-y-2">
                            <!-- Dashboard -->
                            <a href="/dashboard"
                                class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 transition-all duration-300 group @if(Request::is('dashboard')) nav-link-active @endif">
                                <div
                                    class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 text-white flex items-center justify-center shadow-md group-hover:shadow-lg transition-all">
                                    <i class="fas fa-chart-pie text-lg"></i>
                                </div>
                                <div class="flex-1">
                                    <span class="font-semibold text-base">Dashboard</span>
                                    <p class="text-xs text-gray-500">Overview & Analytics</p>
                                </div>
                                @if(Request::is('dashboard'))
                                    <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                                @endif
                            </a>

                            <!-- In your layout file sidebar - add this with the other nav links -->
                            <a href="/classes"
                                class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 transition-all duration-300 group @if(Request::is('classes')) nav-link-active @endif">
                                <div
                                    class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-500 to-purple-600 text-white flex items-center justify-center shadow-md group-hover:shadow-lg transition-all">
                                    <i class="fas fa-book-open text-lg"></i>
                                </div>
                                <div class="flex-1">
                                    <span class="font-semibold text-base">My Classes</span>
                                    <p class="text-xs text-gray-500">View all classes</p>
                                </div>
                                @if(Request::is('classes'))
                                    <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                                @endif
                            </a>

                            <!-- Settings -->
                            <a href="/settings"
                                class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 transition-all duration-300 group @if(Request::is('settings*')) nav-link-active @endif">
                                <div
                                    class="w-10 h-10 rounded-lg bg-gradient-to-br from-gray-500 to-gray-600 text-white flex items-center justify-center shadow-md group-hover:shadow-lg transition-all">
                                    <i class="fas fa-cog text-lg"></i>
                                </div>
                                <div class="flex-1">
                                    <span class="font-semibold text-base">Settings</span>
                                    <p class="text-xs text-gray-500">System Configuration</p>
                                </div>
                                @if(Request::is('settings*'))
                                    <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                                @endif
                            </a>

                            <!-- Divider -->
                            <div class="my-4 border-t border-gray-200"></div>

                            <!-- Back Button -->
                            <button onclick="window.history.back()"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 transition-all duration-300 group">
                                <div
                                    class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-500 to-purple-600 text-white flex items-center justify-center shadow-md group-hover:shadow-lg transition-all">
                                    <i class="fas fa-arrow-left text-lg"></i>
                                </div>
                                <div class="flex-1 text-left">
                                    <span class="font-semibold text-base">Go Back</span>
                                    <p class="text-xs text-gray-500">Return to previous page</p>
                                </div>
                                <i class="fas fa-chevron-left text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                            </button>
                        </nav>

                        <!-- Sidebar Footer -->
                        <div class="sticky bottom-0 p-4 border-t border-gray-200/80 bg-gradient-to-r from-gray-50 to-slate-50">
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-database"></i>
                                    <span>v2.0.1</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-circle text-green-500 text-[6px]"></i>
                                    <span>System Online</span>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <!-- Main Content Area - Replace the existing main content section with this -->
                    <main class="main-content animate-slide-up overflow-x-auto">
                        <div class="max-w-full mx-auto">
                            @yield('content')
                        </div>
                    </main>
                @else
                    <!-- Main Content for non-authenticated users -->
                    <main class="main-content animate-slide-up">
                        @yield('content')
                    </main>
                @endif
            </div>

            <!-- Footer -->
            <footer class="glass border-t border-white/20 shadow-2xl">
                <div class="max-w-7xl mx-auto px-4 py-4">
                    <div class="text-center text-gray-600 text-sm">
                        <p>&copy; {{ date('Y') }} Grading System Pro. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    @else
        <!-- Login/Register Pages Content -->
        <main class="min-h-screen">
            @yield('content')
        </main>
    @endif

    <!-- Scripts -->
    <script>
        // Sticky header shadow effect on scroll
        const header = document.getElementById('mainHeader');

        if (header) {
            window.addEventListener('scroll', function () {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 10) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        }

        // Side menu toggle functionality
        function toggleSideMenu() {
            const sideNav = document.getElementById('sideNav');
            const overlay = document.getElementById('menuOverlay');

            if (sideNav) {
                if (sideNav.classList.contains('-translate-x-full')) {
                    sideNav.classList.remove('-translate-x-full');
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                } else {
                    sideNav.classList.add('-translate-x-full');
                    overlay.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            }
        }

        // Close side menu on window resize
        window.addEventListener('resize', function () {
            const sideNav = document.getElementById('sideNav');
            const overlay = document.getElementById('menuOverlay');

            if (window.innerWidth >= 1024) {
                if (sideNav) {
                    sideNav.classList.remove('-translate-x-full');
                    if (overlay) {
                        overlay.classList.remove('active');
                    }
                    document.body.style.overflow = 'auto';
                }
            }
        });

        // SweetAlert2 Logout Confirmation
        function confirmLogout() {
            Swal.fire({
                title: 'Confirm Logout',
                html: `
                    <div class="text-center py-4">
                        <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-sign-out-alt text-white text-3xl"></i>
                        </div>
                        <p class="text-gray-700 font-semibold text-lg mb-2">Are you sure you want to logout?</p>
                        <p class="text-gray-500 text-sm">Your session will be ended and you'll need to login again.</p>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fas fa-sign-out-alt mr-2"></i> Yes, Logout',
                cancelButtonText: '<i class="fas fa-times mr-2"></i> Cancel',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl shadow-2xl',
                    confirmButton: 'py-3 px-6 rounded-xl font-semibold shadow-lg',
                    cancelButton: 'py-3 px-6 rounded-xl font-semibold'
                },
                buttonsStyling: false,
                backdrop: 'rgba(0, 0, 0, 0.4)'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Logging out...',
                        html: `
                            <div class="flex flex-col items-center py-4">
                                <div class="w-16 h-16 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin mb-4"></div>
                                <p class="text-gray-600 font-medium">Securing your session...</p>
                            </div>
                        `,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        customClass: {
                            popup: 'rounded-2xl'
                        }
                    });

                    setTimeout(() => {
                        document.getElementById('logoutForm').submit();
                    }, 1200);
                }
            });
        }

        // SweetAlert toast notifications
        window.showSweetToast = function (message, type = 'info') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                background: type === 'success' ? '#f0fdf4' :
                    type === 'error' ? '#fef2f2' :
                        type === 'warning' ? '#fefce8' : '#eff6ff',
                color: type === 'success' ? '#166534' :
                    type === 'error' ? '#991b1b' :
                        type === 'warning' ? '#854d0e' : '#1e40af',
                iconColor: type === 'success' ? '#22c55e' :
                    type === 'error' ? '#ef4444' :
                        type === 'warning' ? '#eab308' : '#3b82f6',
                customClass: {
                    popup: 'rounded-xl border shadow-2xl',
                    timerProgressBar: 'bg-gradient-to-r from-blue-500 to-indigo-600'
                },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: type,
                title: message
            });
        }

        // Page load animations
        document.addEventListener('DOMContentLoaded', function () {
            document.body.classList.add('animate-fade-in');

            // Display flash messages
            @if(session('success'))
                showSweetToast("{{ session('success') }}", 'success');
            @endif

            @if(session('error'))
                showSweetToast("{{ session('error') }}", 'error');
            @endif

            @if(session('warning'))
                showSweetToast("{{ session('warning') }}", 'warning');
            @endif

            @if(session('info'))
                showSweetToast("{{ session('info') }}", 'info');
            @endif
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                const sideNav = document.getElementById('sideNav');
                const overlay = document.getElementById('menuOverlay');

                if (sideNav && !sideNav.classList.contains('-translate-x-full') && window.innerWidth < 1024) {
                    toggleSideMenu();
                }
                Swal.close();
            }
        });

        // Highlight active nav link based on current URL
        document.addEventListener('DOMContentLoaded', function () {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && href !== '/' && currentPath.startsWith(href)) {
                    link.classList.add('nav-link-active');
                }
            });
        });
    </script>
    @livewireScripts

    @stack('scripts')
</body>

</html>