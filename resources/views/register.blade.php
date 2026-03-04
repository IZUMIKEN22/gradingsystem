@extends('layout')

@section('content')
<div class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700">
        <!-- Animated circles -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Floating shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-20 h-20 border-2 border-white/20 rounded-lg rotate-12 animate-float"></div>
        <div class="absolute top-40 right-20 w-16 h-16 border-2 border-white/20 rounded-full animate-float animation-delay-1000"></div>
        <div class="absolute bottom-32 left-1/4 w-12 h-12 border-2 border-white/20 rounded-lg -rotate-12 animate-float animation-delay-2000"></div>
        <div class="absolute bottom-20 right-1/4 w-24 h-24 border-2 border-white/20 rounded-full animate-float animation-delay-3000"></div>
    </div>

    <!-- Compact Container -->
    <div class="w-full max-w-5xl mx-auto px-4 py-4 relative z-10">
        <!-- Main Card - Fit to Screen -->
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 animate-slide-up max-h-[90vh]">
            <div class="grid md:grid-cols-2 gap-0">
                
                <!-- Left Side - Branding & Info -->
                <div class="bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 p-8 relative overflow-hidden flex flex-col">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
                    
                    <div class="relative z-10 flex-grow">
                        <!-- Logo & Title -->
                        <div class="mb-8 animate-fade-in">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl shadow-xl mb-6 transform hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-graduation-cap text-white text-2xl"></i>
                            </div>
                            <h1 class="text-4xl font-bold text-white mb-4 drop-shadow-lg">
                                Join Our Platform
                            </h1>
                            <p class="text-lg text-blue-100 mb-6">
                                Start your teaching journey today
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Scrollable Registration Form -->
                <div class="p-8 flex flex-col h-[calc(90vh-2rem)]">
                    <!-- Form Container with Scroll -->
                    <div class="flex-grow overflow-y-auto pr-2 scroll-smooth">
                        <div class="max-w-sm mx-auto w-full pb-4">
                            <!-- Header -->
                            <div class="mb-6 text-center">
                                <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                                    Create Account
                                </h2>
                                <p class="text-gray-600 text-sm">Fill in your details to get started</p>
                            </div>

                            <!-- Error Messages -->
                            @if ($errors->any())
                            <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded-r-lg animate-shake">
                                <div class="flex items-start">
                                    <i class="fas fa-exclamation-circle text-red-500 mr-2 mt-0.5"></i>
                                    <div>
                                        <h4 class="font-semibold text-red-800 text-sm mb-1">Please fix the following:</h4>
                                        <ul class="text-xs text-red-600 space-y-0.5">
                                            @foreach ($errors->all() as $error)
                                            <li>• {{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Registration Form -->
                            <form method="POST" action="/register" class="space-y-4" id="registrationForm">
                                @csrf

                                <!-- Full Name Field -->
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Full Name
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200 text-sm"></i>
                                        </div>
                                        <input type="text" 
                                               name="name" 
                                               value="{{ old('name') }}"
                                               class="pl-10 w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white placeholder-gray-400 transition-all duration-200 hover:border-gray-300 text-sm"
                                               placeholder="John Doe"
                                               required
                                               autofocus>
                                    </div>
                                </div>

                                <!-- Email Field -->
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Email Address
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-envelope text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200 text-sm"></i>
                                        </div>
                                        <input type="email" 
                                               name="email" 
                                               value="{{ old('email') }}"
                                               class="pl-10 w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white placeholder-gray-400 transition-all duration-200 hover:border-gray-300 text-sm"
                                               placeholder="john@example.com"
                                               required>
                                    </div>
                                </div>

                                <!-- Username Field -->
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Username
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-at text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200 text-sm"></i>
                                        </div>
                                        <input type="text" 
                                               name="username" 
                                               value="{{ old('username') }}"
                                               class="pl-10 w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white placeholder-gray-400 transition-all duration-200 hover:border-gray-300 text-sm"
                                               placeholder="johndoe"
                                               required>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500 flex items-center gap-1">
                                        <i class="fas fa-info-circle text-xs"></i>
                                        Your unique login identifier
                                    </p>
                                </div>

                                <!-- Password Field -->
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Password
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-lock text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200 text-sm"></i>
                                        </div>
                                        <input type="password" 
                                               name="password" 
                                               id="password"
                                               class="pl-10 pr-10 w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white placeholder-gray-400 transition-all duration-200 hover:border-gray-300 text-sm"
                                               placeholder="Create a secure password"
                                               required>
                                        <button type="button" 
                                                onclick="togglePassword()"
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-blue-600 transition-colors">
                                            <i class="fas fa-eye text-sm" id="eyeIcon"></i>
                                        </button>
                                    </div>

                                    <!-- Password Strength Meter -->
                                    <div class="mt-2 space-y-1">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-semibold text-gray-600">Password Strength</span>
                                            <span id="strengthText" class="text-xs font-bold text-gray-400">None</span>
                                        </div>
                                        <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                            <div id="strengthBar" class="h-full bg-red-400 rounded-full transition-all duration-300" style="width: 0%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" 
                                        id="submitBtn"
                                        class="w-full py-3 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-3 focus:ring-blue-300 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2 group text-sm mt-2">
                                    <i class="fas fa-user-plus group-hover:scale-110 transition-transform"></i>
                                    <span id="btnText">Create Account</span>
                                </button>
                            </form>
                            
                            <!-- Login Link -->
                            <div class="mt-4 text-center">
                                <p class="text-xs text-gray-600 mb-2">Already have an account?</p>
                                <a href="/login" 
                                   class="inline-flex items-center justify-center gap-2 px-5 py-2 bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700 font-semibold rounded-lg border-2 border-gray-200 hover:border-blue-300 hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200 group text-xs">
                                    <i class="fas fa-sign-in-alt group-hover:scale-110 transition-transform text-xs"></i>
                                    <span>Sign In Instead</span>
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
    0%, 100% {
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
    0%, 100% {
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
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.animate-shake {
    animation: shake 0.5s ease-out;
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

/* Custom scrollbar for form */
.scroll-smooth {
    scroll-behavior: smooth;
}

.scroll-smooth::-webkit-scrollbar {
    width: 6px;
}

.scroll-smooth::-webkit-scrollbar-track {
    background: rgba(59, 130, 246, 0.05);
    border-radius: 3px;
}

.scroll-smooth::-webkit-scrollbar-thumb {
    background: rgba(59, 130, 246, 0.2);
    border-radius: 3px;
}

.scroll-smooth::-webkit-scrollbar-thumb:hover {
    background: rgba(59, 130, 246, 0.3);
}

/* Make it fit screen */
html, body {
    height: 100%;
    overflow: hidden;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .grid.md\:grid-cols-2 {
        grid-template-columns: 1fr;
    }
    
    .max-h-[90vh] {
        max-height: none;
        margin: 0.5rem;
    }
    
    .h-[calc(90vh-2rem)] {
        height: auto;
        max-height: 70vh;
    }
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

// Password strength checker
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    const form = document.getElementById('registrationForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        
        if (password.length >= 8) strength += 25;
        if (/[a-z]/.test(password)) strength += 25;
        if (/[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password)) strength += 15;
        if (/[^A-Za-z0-9]/.test(password)) strength += 10;
        
        strengthBar.style.width = `${Math.min(strength, 100)}%`;
        
        let color = 'bg-red-400';
        let text = 'Weak';
        
        if (strength >= 40 && strength < 70) {
            color = 'bg-yellow-400';
            text = 'Fair';
        } else if (strength >= 70 && strength < 90) {
            color = 'bg-blue-400';
            text = 'Good';
        } else if (strength >= 90) {
            color = 'bg-green-400';
            text = 'Strong';
        }
        
        strengthBar.className = `h-full ${color} rounded-full transition-all duration-300`;
        strengthText.textContent = text;
        strengthText.className = `text-xs font-bold ${
            strength >= 90 ? 'text-green-600' :
            strength >= 70 ? 'text-blue-600' :
            strength >= 40 ? 'text-yellow-600' : 'text-red-600'
        }`;
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        const termsCheckbox = document.getElementById('terms');
        if (!termsCheckbox.checked) {
            e.preventDefault();
            termsCheckbox.parentElement.classList.add('animate-shake', 'border-red-300');
            setTimeout(() => {
                termsCheckbox.parentElement.classList.remove('animate-shake', 'border-red-300');
            }, 800);
            return;
        }

        submitBtn.disabled = true;
        btnText.textContent = 'Creating Account...';
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i><span>Creating Account...</span>';
    });

    // Clear error styles on input
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('border-red-500', 'bg-red-50');
        });
    });

    // Scroll to top when form has errors
    @if ($errors->any())
        const formContainer = document.querySelector('.scroll-smooth');
        if (formContainer) {
            formContainer.scrollTop = 0;
        }
    @endif
});
</script>
@endsection