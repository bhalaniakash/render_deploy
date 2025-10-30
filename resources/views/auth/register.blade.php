@extends('layouts.app')

@section('title', 'Register')
@section('page-title', 'Create Account')
@section('subtitle', 'Join us to manage your finances')

@section('topright')
    <a href="{{ route('login') }}" class="text-white/90 hover:text-white transition-colors">
        Already have an account? <span class="font-semibold">Sign in</span>
    </a>
@endsection

@section('content')
<div class="max-w-md mx-auto animate-fade-in">
    <!-- Error Messages -->
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-3 text-xl"></i>
                <div>
                    <h4 class="text-red-800 font-semibold">Please fix the following errors:</h4>
                    <ul class="text-red-700 mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Registration Form -->
    <div class="glass-effect rounded-xl p-8 card-hover">
        <form method="POST" action="{{ route('register.post') }}" data-validate="password-match" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <div class="relative">
                    <input type="text" name="name" value="{{ old('name') }}" 
                           class="w-full px-4 py-3 pl-11 rounded-lg border border-gray-300 input-focus transition-all" 
                           placeholder="Enter your full name" required>
                    <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="w-full px-4 py-3 pl-11 rounded-lg border border-gray-300 input-focus transition-all" 
                           placeholder="Enter your email" required>
                    <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <input type="password" name="password" 
                           class="w-full px-4 py-3 pl-11 rounded-lg border border-gray-300 input-focus transition-all" 
                           placeholder="Create a password" required>
                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" 
                           class="w-full px-4 py-3 pl-11 rounded-lg border border-gray-300 input-focus transition-all" 
                           placeholder="Confirm your password" required>
                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <div id="password-match-message" class="mt-2 text-sm hidden">
                    <i class="fas fa-check-circle text-green-500 mr-1"></i>
                    <span class="text-green-600">Passwords match!</span>
                </div>
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" name="terms" class="rounded border-gray-300 text-primary focus:ring-primary" required>
                <span class="ml-2 text-sm text-gray-600">
                    I agree to the 
                    <a href="#" class="text-primary hover:text-primary-dark font-medium">Terms of Service</a> 
                    and 
                    <a href="#" class="text-primary hover:text-primary-dark font-medium">Privacy Policy</a>
                </span>
            </div>
            
            <button type="submit" class="w-full btn-primary text-white py-3 px-4 rounded-lg font-semibold transition-all">
                <i class="fas fa-user-plus mr-2"></i>Create Account
            </button>
        </form>
        
        <div class="mt-6 pt-6 border-t border-gray-200">
            <p class="text-center text-gray-600 text-sm">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-primary hover:text-primary-dark font-semibold">
                    Sign in here
                </a>
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const password = document.querySelector('input[name="password"]');
        const confirmPassword = document.querySelector('input[name="password_confirmation"]');
        const message = document.getElementById('password-match-message');
        
        function checkPasswordMatch() {
            if (password.value && confirmPassword.value) {
                if (password.value === confirmPassword.value) {
                    confirmPassword.classList.add('border-green-500');
                    confirmPassword.classList.remove('border-red-500');
                    message.classList.remove('hidden');
                } else {
                    confirmPassword.classList.add('border-red-500');
                    confirmPassword.classList.remove('border-green-500');
                    message.classList.add('hidden');
                }
            } else {
                confirmPassword.classList.remove('border-green-500', 'border-red-500');
                message.classList.add('hidden');
            }
        }
        
        password.addEventListener('input', checkPasswordMatch);
        confirmPassword.addEventListener('input', checkPasswordMatch);
    });
</script>
@endpush
@endsection