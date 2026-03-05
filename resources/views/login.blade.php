@extends('layout')

@section('title', 'Login - Grading System')

@section('content')
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700">
            <!-- Animated circles -->
            <div
                class="absolute top-0 left-0 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
            </div>
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute bottom-0 left-1/2 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000">
            </div>
        </div>

        <!-- Floating shapes -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-20 h-20 border-2 border-white/20 rounded-lg rotate-12 animate-float">
            </div>
            <div
                class="absolute top-40 right-20 w-16 h-16 border-2 border-white/20 rounded-full animate-float animation-delay-1000">
            </div>
            <div
                class="absolute bottom-32 left-1/4 w-12 h-12 border-2 border-white/20 rounded-lg -rotate-12 animate-float animation-delay-2000">
            </div>
            <div
                class="absolute bottom-20 right-1/4 w-24 h-24 border-2 border-white/20 rounded-full animate-float animation-delay-3000">
            </div>
        </div>

        <!-- Compact Container -->
        <div class="w-full max-w-5xl mx-auto px-4 py-4 relative z-10">
            <!-- Main Card - More Compact -->
            <div
                class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 animate-slide-up max-h-[90vh]">
                <div class="grid md:grid-cols-2 gap-0 min-h-[550px]">

                    <!-- Left Side - Compact Branding -->
                    <div
                        class="bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 p-8 flex flex-col justify-center relative overflow-hidden">
                        <!-- Simplified decorative elements -->
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 animate-pulse-slow">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24 animate-pulse-slow animation-delay-2000">
                        </div>

                        <div class="relative z-10 text-center">
                            <!-- Compact Logo & Title -->
                            <div class="mb-6 animate-fade-in">
                                <!-- Logo Container -->
                                <div
                                    class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-white/25 to-white/10 backdrop-blur-xl rounded-2xl shadow-xl mb-6 transform hover:scale-110 transition-all duration-500 hover:rotate-3">
                                    <i class="fas fa-graduation-cap text-white text-3xl"></i>
                                </div>

                                <!-- Title -->
                                <h1 class="text-5xl md:text-6xl font-black text-white mb-4 leading-tight drop-shadow-xl">
                                    Grading<br>System
                                </h1>

                                <!-- Tagline -->
                                <div class="mb-6">
                                    <p class="text-xl font-bold text-blue-100 mb-2">
                                        Intelligent Grade Management
                                    </p>
                                    <p class="text-lg text-blue-100/90">
                                        Empowering Educators
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Login Form -->
                    <div class="p-8 flex flex-col justify-center">
                        <div class="max-w-sm mx-auto w-full">
                            <!-- Header -->
                            <div class="mb-6 text-center">
                                <h2
                                    class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                                    Welcome Back!
                                </h2>
                                <p class="text-gray-600">Sign in to your account</p>
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

                            @if(session('success'))
                                <div class="mb-4 p-3 bg-green-50 border-l-4 border-green-500 rounded-r-lg animate-pulse-once">
                                    <div class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Login Form -->
                            <form method="POST" action="/login" class="space-y-4">
                                @csrf

                                <!-- Username Field -->
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Username
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-user text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200"></i>
                                        </div>
                                        <input type="text" name="username"
                                            class="pl-10 w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white placeholder-gray-400 transition-all duration-200 hover:border-gray-300"
                                            placeholder="Enter your username" required autofocus>
                                    </div>
                                </div>

                                <!-- Password Field -->
                                <div class="group">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="block text-sm font-semibold text-gray-700">
                                            Password
                                        </label>
                                        <a href="#"
                                            class="text-xs font-semibold text-blue-600 hover:text-blue-700 hover:underline transition-colors">
                                            Forgot?
                                        </a>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-lock text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200"></i>
                                        </div>
                                        <input type="password" name="password" id="password"
                                            class="pl-10 pr-10 w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white placeholder-gray-400 transition-all duration-200 hover:border-gray-300"
                                            placeholder="Enter your password" required>
                                        <button type="button" onclick="togglePassword()"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-blue-600 transition-colors">
                                            <i class="fas fa-eye" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit"
                                    class="w-full py-3.5 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-3 focus:ring-blue-300 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2 group mt-2">
                                    <i class="fas fa-sign-in-alt group-hover:scale-110 transition-transform"></i>
                                    <span>Sign In</span>
                                </button>
                            </form>

                            <!-- Divider with "Or" -->
                            <div class="relative my-6">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-3 bg-white text-gray-500 font-medium">Or sign in with</span>
                                </div>
                            </div>

                            <!-- Google Button - Moved Below Form -->
                            <div class="flex justify-center mb-4">
                                <div class="w-full">
                                    <!-- Google Sign In -->
                                    <a href="/auth/google"
                                        class="flex items-center justify-center gap-2 px-4 py-3 bg-white border-2 border-gray-200 rounded-xl hover:border-blue-500 hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200 group">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                                            <path fill="#4285F4"
                                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                            <path fill="#34A853"
                                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                            <path fill="#FBBC05"
                                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                            <path fill="#EA4335"
                                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                        </svg>
                                        <span class="font-semibold text-gray-700 text-sm">Continue with Google</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Register Link - Now inline as simple link -->
                            <div class="mt-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <p class="text-sm text-gray-600">Don't have an account?</p>
                                    <a href="/register"
                                        class="text-sm font-semibold text-blue-600 hover:text-blue-700 hover:underline transition-colors">
                                        Create Account
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Animations & Styles -->
    <style>
        /* Blob Animation */
        @keyframes blob {

            0%,
            100% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Float Animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animation-delay-1000 {
            animation-delay: 1s;
        }

        .animation-delay-3000 {
            animation-delay: 3s;
        }

        /* Fade In Animation */
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }

        /* Slide Up Animation */
        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slide-up 0.8s ease-out 0.2s both;
        }

        /* Shake Animation */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .animate-shake {
            animation: shake 0.5s ease-out;
        }

        /* Pulse Once Animation */
        @keyframes pulse-once {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        .animate-pulse-once {
            animation: pulse-once 0.6s ease-out;
        }

        /* New Animations */
        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 0.3;
                transform: scale(1);
            }

            50% {
                opacity: 0.4;
                transform: scale(1.05);
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }

        /* Enhanced focus states */
        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Smooth transitions */
        * {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Compact mobile adjustments */
        @media (max-width: 768px) {
            .grid.md\:grid-cols-2 {
                grid-template-columns: 1fr;
            }

            .min-h-[550px] {
                min-height: auto;
            }

            .max-h-[90vh] {
                max-height: none;
                margin: 1rem;
            }

            .text-6xl {
                font-size: 3rem;
            }

            .text-5xl {
                font-size: 2.5rem;
            }
        }

        /* Make it fit screen */
        html,
        body {
            height: 100%;
            overflow: hidden;
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
                eyeIcon.classList.add('text-blue-600');
                setTimeout(() => {
                    eyeIcon.classList.remove('text-blue-600');
                }, 300);
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
                eyeIcon.classList.add('text-blue-600');
                setTimeout(() => {
                    eyeIcon.classList.remove('text-blue-600');
                }, 300);
            }
        }

        // Enhanced form validation
        document.querySelector('form').addEventListener('submit', function (e) {
            const username = this.querySelector('input[name="username"]');
            const password = this.querySelector('input[name="password"]');
            const submitBtn = this.querySelector('button[type="submit"]');
            let hasError = false;

            // Reset previous error states
            username.classList.remove('border-red-500', 'bg-red-50', 'animate-shake');
            password.classList.remove('border-red-500', 'bg-red-50', 'animate-shake');

            if (!username.value.trim()) {
                e.preventDefault();
                username.classList.add('border-red-500', 'bg-red-50', 'animate-shake');
                username.focus();
                hasError = true;
            }

            if (!password.value.trim()) {
                e.preventDefault();
                password.classList.add('border-red-500', 'bg-red-50', 'animate-shake');
                if (!hasError) password.focus();
                hasError = true;
            }

            // Add loading state if no errors
            if (!hasError && !submitBtn.disabled) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i><span>Signing in...</span>';
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-90', 'cursor-not-allowed');
            }
        });

        // Clear error styles on input
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', function () {
                this.classList.remove('border-red-500', 'bg-red-50', 'animate-shake');
            });
        });

        // Add ripple effect to buttons
        document.querySelectorAll('button, a').forEach(element => {
            element.addEventListener('click', function (e) {
                if (this.classList.contains('relative')) return;

                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(59, 130, 246, 0.2);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s ease-out;
                pointer-events: none;
            `;

                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);

                setTimeout(() => ripple.remove(), 600);
            });
        });
    </script>

    <style>
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
@endsection