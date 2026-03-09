@extends('layout')

@section('title', 'Admin Login - Grading System')

@section('content')
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <!-- Animated Background with different colors for admin -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-slate-900 to-black">
            <!-- Animated circles -->
            <div
                class="absolute top-0 left-0 w-96 h-96 bg-indigo-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
            </div>
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-purple-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute bottom-0 left-1/2 w-96 h-96 bg-pink-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000">
            </div>
        </div>

        <!-- Floating shapes -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-20 h-20 border-2 border-white/5 rounded-lg rotate-12 animate-float">
            </div>
            <div
                class="absolute top-40 right-20 w-16 h-16 border-2 border-white/5 rounded-full animate-float animation-delay-1000">
            </div>
            <div
                class="absolute bottom-32 left-1/4 w-12 h-12 border-2 border-white/5 rounded-lg -rotate-12 animate-float animation-delay-2000">
            </div>
            <div
                class="absolute bottom-20 right-1/4 w-24 h-24 border-2 border-white/5 rounded-full animate-float animation-delay-3000">
            </div>
        </div>

        <!-- Compact Container -->
        <div class="w-full max-w-5xl mx-auto px-4 py-4 relative z-10">
            <!-- Main Card - More Compact -->
            <div
                class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/10 animate-slide-up max-h-[90vh]">
                <div class="grid md:grid-cols-2 gap-0 min-h-[550px]">

                    <!-- Left Side - Admin Branding -->
                    <div
                        class="bg-gradient-to-br from-gray-900 via-slate-900 to-black p-8 flex flex-col justify-center relative overflow-hidden">
                        <!-- Simplified decorative elements -->
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full -mr-32 -mt-32 animate-pulse-slow">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-48 h-48 bg-purple-500/10 rounded-full -ml-24 -mb-24 animate-pulse-slow animation-delay-2000">
                        </div>

                        <div class="relative z-10 text-center">
                            <!-- Compact Logo & Title -->
                            <div class="mb-6 animate-fade-in">
                                <!-- Logo Container -->
                                <div
                                    class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 backdrop-blur-xl rounded-2xl shadow-xl mb-6 transform hover:scale-110 transition-all duration-500 hover:rotate-3 border border-white/10">
                                    <i class="fas fa-shield-alt text-white text-3xl"></i>
                                </div>

                                <!-- Title -->
                                <h1 class="text-5xl md:text-6xl font-black text-white mb-4 leading-tight drop-shadow-xl">
                                    Admin<br>Portal
                                </h1>

                                <!-- Tagline -->
                                <div class="mb-6">
                                    <p class="text-xl font-bold text-indigo-300 mb-2">
                                        System Administration
                                    </p>
                                    <p class="text-lg text-gray-400">
                                        Manage & Monitor
                                    </p>
                                </div>

                                <!-- Admin Badge -->
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 rounded-full border border-white/10">
                                    <i class="fas fa-crown text-yellow-500 text-sm"></i>
                                    <span class="text-xs font-medium text-gray-300">Administrator Access Only</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Admin Login Form -->
                    <div class="p-8 flex flex-col justify-center">
                        <div class="max-w-sm mx-auto w-full">
                            <!-- Header -->
                            <div class="mb-6 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl shadow-xl mb-4">
                                    <i class="fas fa-lock text-white text-xl"></i>
                                </div>
                                <h2
                                    class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-2">
                                    Admin Login
                                </h2>
                                <p class="text-gray-600">Secure access for administrators</p>
                            </div>

                            <!-- Error Alert (hidden by default) -->
                            <div id="errorAlert" class="hidden mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                                <div class="flex items-start">
                                    <i class="fas fa-exclamation-circle text-red-500 mr-2 mt-0.5"></i>
                                    <p id="errorMessage" class="text-sm font-medium text-red-800">Invalid credentials</p>
                                </div>
                            </div>

                            <!-- Success Alert (hidden by default) -->
                            <div id="successAlert" class="hidden mb-4 p-3 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                                    <p id="successMessage" class="text-sm font-medium text-green-800">Login successful! Redirecting...</p>
                                </div>
                            </div>

                            <!-- Admin Login Form - JS Verification Only -->
                            <form id="adminLoginForm" class="space-y-4" onsubmit="return handleAdminLogin(event)">
                                @csrf

                                <!-- Email Field -->
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Email Address
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-envelope text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
                                        </div>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                            class="pl-10 w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white placeholder-gray-400 transition-all duration-200 hover:border-gray-300"
                                            placeholder="admin@example.com" required autofocus>
                                    </div>
                                </div>

                                <!-- Password Field -->
                                <div class="group">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="block text-sm font-semibold text-gray-700">
                                            Password
                                        </label>
                                        <a href="#"
                                            class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 hover:underline transition-colors">
                                            Forgot Password?
                                        </a>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-lock text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
                                        </div>
                                        <input type="password" id="password" name="password"
                                            class="pl-10 pr-10 w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white placeholder-gray-400 transition-all duration-200 hover:border-gray-300"
                                            placeholder="Enter your password" required>
                                        <button type="button" onclick="togglePassword()"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-indigo-600 transition-colors">
                                            <i class="fas fa-eye" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Remember Me -->
                                <div class="flex items-center justify-between">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="remember" id="remember"
                                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" id="submitBtn"
                                    class="w-full py-3.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-3 focus:ring-indigo-300 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2 group mt-2">
                                    <i class="fas fa-sign-in-alt group-hover:scale-110 transition-transform"></i>
                                    <span id="btnText">Access Admin Panel</span>
                                </button>
                            </form>

                            <!-- Divider -->
                            <div class="relative my-6">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-3 bg-white text-gray-500 font-medium">Administrator Access</span>
                                </div>
                            </div>

                            <!-- Back to Main Login -->
                            <div class="text-center">
                                <a href="/login" 
                                    class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-indigo-600 transition-colors group">
                                    <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                                    <span>Back to Teacher Login</span>
                                </a>
                            </div>

                            <!-- Default Credentials Info -->
                            <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                                <p class="text-xs font-semibold text-gray-500 mb-2">Demo Credentials:</p>
                                <div class="space-y-1 text-xs text-gray-600">
                                    <p><span class="font-medium">Email:</span> admin@admin.com</p>
                                    <p><span class="font-medium">Password:</span> password</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animation-delay-1000 { animation-delay: 1s; }
        .animation-delay-3000 { animation-delay: 3s; }
        
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.8s ease-out; }
        
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up { animation: slide-up 0.8s ease-out 0.2s both; }
        
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.05); }
        }
        .animate-pulse-slow { animation: pulse-slow 4s ease-in-out infinite; }
        
        html, body { height: 100%; overflow: hidden; }
        
        @media (max-width: 768px) {
            .grid.md\:grid-cols-2 { grid-template-columns: 1fr; }
            .min-h-[550px] { min-height: auto; }
            .max-h-[90vh] { max-height: none; margin: 1rem; }
        }
    </style>

    <script>
        // Admin credentials (hardcoded for demo)
        const ADMIN_CREDENTIALS = {
            email: 'admin@admin.com',
            password: 'password'
        };

        // Password toggle function
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
                eyeIcon.classList.add('text-indigo-600');
                setTimeout(() => {
                    eyeIcon.classList.remove('text-indigo-600');
                }, 300);
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
                eyeIcon.classList.add('text-indigo-600');
                setTimeout(() => {
                    eyeIcon.classList.remove('text-indigo-600');
                }, 300);
            }
        }

        // Handle admin login
        function handleAdminLogin(event) {
            event.preventDefault();
            
            // Get form values
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const remember = document.getElementById('remember').checked;
            
            // Get alert elements
            const errorAlert = document.getElementById('errorAlert');
            const successAlert = document.getElementById('successAlert');
            const errorMessage = document.getElementById('errorMessage');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            
            // Hide any previous alerts
            errorAlert.classList.add('hidden');
            successAlert.classList.add('hidden');
            
            // Remove any previous error styling
            document.getElementById('email').classList.remove('border-red-500', 'bg-red-50');
            document.getElementById('password').classList.remove('border-red-500', 'bg-red-50');
            
            // Validate email format
            if (!isValidEmail(email)) {
                showError('Please enter a valid email address');
                document.getElementById('email').classList.add('border-red-500', 'bg-red-50');
                document.getElementById('email').focus();
                return false;
            }
            
            // Validate password not empty
            if (!password) {
                showError('Password is required');
                document.getElementById('password').classList.add('border-red-500', 'bg-red-50');
                document.getElementById('password').focus();
                return false;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            btnText.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Verifying...';
            submitBtn.classList.add('opacity-90', 'cursor-not-allowed');
            
            // Simulate network delay (remove in production)
            setTimeout(() => {
                // Check credentials against hardcoded values
                if (email === ADMIN_CREDENTIALS.email && password === ADMIN_CREDENTIALS.password) {
                    // Success
                    successAlert.classList.remove('hidden');
                    
                    // Store in sessionStorage if remember me is checked
                    if (remember) {
                        sessionStorage.setItem('admin_authenticated', 'true');
                        sessionStorage.setItem('admin_email', email);
                        sessionStorage.setItem('admin_remember', 'true');
                    } else {
                        sessionStorage.setItem('admin_authenticated', 'true');
                        sessionStorage.setItem('admin_email', email);
                    }
                    
                    // Also set a cookie for additional persistence (optional)
                    document.cookie = "admin_authenticated=true; path=/";
                    
                    // Reset button state
                    submitBtn.disabled = false;
                    btnText.innerHTML = 'Access Admin Panel';
                    submitBtn.classList.remove('opacity-90', 'cursor-not-allowed');
                    
                    // Redirect to admin dashboard after 1.5 seconds
                    setTimeout(() => {
                        window.location.href = '/admin/dashboard';
                    }, 1500);
                } else {
                    // Error
                    showError('Invalid email or password');
                    
                    // Reset button state
                    submitBtn.disabled = false;
                    btnText.innerHTML = 'Access Admin Panel';
                    submitBtn.classList.remove('opacity-90', 'cursor-not-allowed');
                    
                    // Shake the form
                    document.querySelector('.max-w-sm').classList.add('animate-shake');
                    setTimeout(() => {
                        document.querySelector('.max-w-sm').classList.remove('animate-shake');
                    }, 500);
                }
            }, 800); // Simulate network delay
            
            return false;
        }
        
        // Helper function to show error
        function showError(message) {
            const errorAlert = document.getElementById('errorAlert');
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.textContent = message;
            errorAlert.classList.remove('hidden');
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                errorAlert.classList.add('hidden');
            }, 5000);
        }
        
        // Email validation function
        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }
        
        // Check if already authenticated
        function checkAuth() {
            // Check sessionStorage
            if (sessionStorage.getItem('admin_authenticated') === 'true') {
                // Redirect to admin dashboard if already logged in
                window.location.href = '/admin/dashboard';
                return true;
            }
            
            // Check cookie as backup
            if (document.cookie.includes('admin_authenticated=true')) {
                window.location.href = '/admin/dashboard';
                return true;
            }
            
            return false;
        }
        
        // Run check on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Don't auto-redirect if we're already on the login page
            if (!window.location.pathname.includes('/admin/login')) {
                checkAuth();
            }
            
            // Add input event listeners to remove error styling
            document.getElementById('email').addEventListener('input', function() {
                this.classList.remove('border-red-500', 'bg-red-50');
                document.getElementById('errorAlert').classList.add('hidden');
            });
            
            document.getElementById('password').addEventListener('input', function() {
                this.classList.remove('border-red-500', 'bg-red-50');
                document.getElementById('errorAlert').classList.add('hidden');
            });
        });
        
        // Prevent form submission on enter key
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA' && document.activeElement.tagName !== 'BUTTON') {
                e.preventDefault();
                handleAdminLogin(e);
            }
        });
        
        // Clear auth on logout (if you add a logout button)
        function logout() {
            sessionStorage.removeItem('admin_authenticated');
            sessionStorage.removeItem('admin_email');
            sessionStorage.removeItem('admin_remember');
            document.cookie = "admin_authenticated=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            window.location.href = '/admin/login';
        }
    </script>
@endsection