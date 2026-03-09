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

                            <!-- Alerts -->
                            @if(session('error'))
                                <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded-r-lg animate-shake">
                                    <div class="flex items-start">
                                        <i class="fas fa-exclamation-circle text-red-500 mr-2 mt-0.5"></i>
                                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded-r-lg animate-shake">
                                    <div class="flex items-start">
                                        <i class="fas fa-exclamation-circle text-red-500 mr-2 mt-0.5"></i>
                                        <p class="text-sm font-medium text-red-800">{{ $errors->first() }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Admin Login Form -->
                            <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
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
                                        <input type="email" name="email" value="{{ old('email') }}"
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
                                        <input type="password" name="password" id="password"
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
                                        <input type="checkbox" name="remember" 
                                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit"
                                    class="w-full py-3.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-3 focus:ring-indigo-300 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2 group mt-2">
                                    <i class="fas fa-sign-in-alt group-hover:scale-110 transition-transform"></i>
                                    <span>Access Admin Panel</span>
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

                            <!-- Default Credentials Info (Remove in production) -->
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

    <!-- Include the same animations from your main login -->
    <style>
        /* Copy all the animation styles from your main login here */
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
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        .animate-shake { animation: shake 0.5s ease-out; }
        
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

        // Form validation
        document.querySelector('form').addEventListener('submit', function (e) {
            const email = this.querySelector('input[name="email"]');
            const password = this.querySelector('input[name="password"]');
            const submitBtn = this.querySelector('button[type="submit"]');
            let hasError = false;

            email.classList.remove('border-red-500', 'bg-red-50', 'animate-shake');
            password.classList.remove('border-red-500', 'bg-red-50', 'animate-shake');

            if (!email.value.trim()) {
                e.preventDefault();
                email.classList.add('border-red-500', 'bg-red-50', 'animate-shake');
                email.focus();
                hasError = true;
            } else if (!isValidEmail(email.value.trim())) {
                e.preventDefault();
                email.classList.add('border-red-500', 'bg-red-50', 'animate-shake');
                email.focus();
                hasError = true;
            }

            if (!password.value.trim()) {
                e.preventDefault();
                password.classList.add('border-red-500', 'bg-red-50', 'animate-shake');
                if (!hasError) password.focus();
                hasError = true;
            }

            if (!hasError && !submitBtn.disabled) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i><span>Accessing...</span>';
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-90', 'cursor-not-allowed');
            }
        });

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', function () {
                this.classList.remove('border-red-500', 'bg-red-50', 'animate-shake');
            });
        });
    </script>
@endsection