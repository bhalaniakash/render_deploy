@extends('layouts.app')

@section('title', 'Login')
@section('page-title', 'Welcome Back!')
@section('subtitle', 'Sign in to your account')

@section('topright')
    <a href="{{ route('register') }}" class="text-white/90 hover:text-white transition-colors">
        Don't have an account? <span class="font-semibold">Sign up</span>
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
                    <h4 class="text-red-800 font-semibold">Login failed</h4>
                    <p class="text-red-700 mt-1 text-sm">{{ $errors->first() }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Login Form -->
    <div class="glass-effect rounded-xl p-8 card-hover">
        <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
            @csrf
            
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
                           placeholder="Enter your password" required>
                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                
                <a href="#" class="text-sm text-primary hover:text-primary-dark font-medium">
                    Forgot password?
                </a>
            </div>
            
            <button type="submit" class="w-full btn-primary text-white py-3 px-4 rounded-lg font-semibold transition-all">
                <i class="fas fa-sign-in-alt mr-2"></i>Sign In
            </button>
        </form>
        
        <div class="mt-6 pt-6 border-t border-gray-200">
            <p class="text-center text-gray-600 text-sm">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-primary hover:text-primary-dark font-semibold">
                    Create one here
                </a>
            </p>
        </div>
    </div>
    
    <!-- Demo Info -->
    <div class="mt-6 text-center">
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
            <h4 class="text-blue-800 font-semibold text-sm mb-2">
                <i class="fas fa-info-circle mr-1"></i>Demo Access
            </h4>
            <p class="text-blue-700 text-xs">
                Try with: demo@example.com / password
            </p>
        </div>
    </div>
</div>
@endsection