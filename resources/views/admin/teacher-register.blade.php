@extends('layout')

@section('title', 'Register Teacher - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-slate-900 to-black">
    <!-- Navigation -->
    <nav class="bg-white/10 backdrop-blur-xl border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user-plus text-indigo-400 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-xl font-bold text-white">Register New Teacher</h1>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="/admin/dashboard" 
                        class="px-4 py-2 bg-gray-600/20 hover:bg-gray-600/40 text-gray-300 rounded-lg transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Dashboard</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white/5 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden">
            <div class="px-6 py-4 border-b border-white/10">
                <h3 class="text-lg font-semibold text-white">Teacher Registration Form</h3>
                <p class="text-sm text-gray-400">Fill in the details to create a new teacher account</p>
            </div>

            <div class="p-6">
                <form id="teacherRegistrationForm" class="space-y-6">
                    @csrf
                    
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Full Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name"
                               required
                               class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                               placeholder="Enter teacher's full name">
                        <div class="text-red-400 text-xs mt-1 hidden" id="name-error"></div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Email Address <span class="text-red-400">*</span>
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email"
                               required
                               class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                               placeholder="teacher@example.com">
                        <div class="text-red-400 text-xs mt-1 hidden" id="email-error"></div>
                    </div>

                    <!-- Username -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Username <span class="text-red-400">*</span>
                        </label>
                        <input type="text" 
                               name="username" 
                               id="username"
                               required
                               class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                               placeholder="Choose a username">
                        <div class="text-red-400 text-xs mt-1 hidden" id="username-error"></div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Password <span class="text-red-400">*</span>
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password"
                               required
                               minlength="8"
                               class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                               placeholder="Minimum 8 characters">
                        <div class="text-red-400 text-xs mt-1 hidden" id="password-error"></div>
                        <p class="text-gray-500 text-xs mt-1">Password must be at least 8 characters long</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Confirm Password <span class="text-red-400">*</span>
                        </label>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation"
                               required
                               class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                               placeholder="Re-enter password">
                        <div class="text-red-400 text-xs mt-1 hidden" id="password_confirmation-error"></div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" 
                                id="submitBtn"
                                class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-all duration-200 flex items-center gap-2">
                            <i class="fas fa-save"></i>
                            <span>Register Teacher</span>
                        </button>
                        <button type="reset" 
                                class="px-6 py-2 bg-gray-600/20 hover:bg-gray-600/40 text-gray-300 rounded-lg transition-all duration-200">
                            Reset Form
                        </button>
                    </div>
                </form>

                <!-- Success Message -->
                <div id="successMessage" class="hidden mt-6 p-4 bg-green-600/20 border border-green-600/30 rounded-lg">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        <div>
                            <h4 class="text-green-400 font-medium">Success!</h4>
                            <p id="successText" class="text-green-300 text-sm">Teacher registered successfully.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('teacherRegistrationForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Clear previous errors
    document.querySelectorAll('[id$="-error"]').forEach(el => {
        el.classList.add('hidden');
        el.textContent = '';
    });
    
    // Disable submit button
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Registering...';
    
    try {
        const formData = new FormData(this);
        
        // FIXED: Use the correct API endpoint
        const response = await fetch('/admin/api/teachers/register', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Show success message
            document.getElementById('successMessage').classList.remove('hidden');
            document.getElementById('successText').textContent = data.message;
            
            // Reset form
            this.reset();
            
            // Hide success message after 5 seconds and redirect
            setTimeout(() => {
                document.getElementById('successMessage').classList.add('hidden');
                window.location.href = '/admin/dashboard';
            }, 2000);
        } else {
            // Handle validation errors
            if (data.errors) {
                Object.keys(data.errors).forEach(field => {
                    const errorDiv = document.getElementById(`${field}-error`);
                    if (errorDiv) {
                        errorDiv.textContent = data.errors[field][0];
                        errorDiv.classList.remove('hidden');
                    }
                });
            } else {
                alert(data.message || 'Registration failed');
            }
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred during registration');
    } finally {
        // Re-enable submit button
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Register Teacher';
    }
});

// Real-time validation
document.querySelectorAll('#teacherRegistrationForm input').forEach(input => {
    input.addEventListener('input', function() {
        const errorDiv = document.getElementById(`${this.name}-error`);
        if (errorDiv) {
            errorDiv.classList.add('hidden');
        }
    });
});

// Password match validation
document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    const errorDiv = document.getElementById('password_confirmation-error');
    
    if (password !== confirmPassword) {
        errorDiv.textContent = 'Passwords do not match';
        errorDiv.classList.remove('hidden');
    } else {
        errorDiv.classList.add('hidden');
    }
});

// Password strength indicator (optional)
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthIndicator = document.getElementById('password-strength');
    
    if (password.length < 8) {
        // Password too short - handled by minlength attribute
    }
});
</script>
@endsection