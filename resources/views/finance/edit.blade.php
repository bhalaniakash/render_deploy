@extends('layouts.app')

@section('title', 'Edit Transaction')
@section('page-title', 'Edit Transaction')
@section('subtitle', 'Update your financial record')

@section('content')
<div class="max-w-2xl mx-auto animate-fade-in">
    <!-- Error Messages -->
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6 animate-shake">
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

    <!-- Edit Form -->
    <div class="glass-effect rounded-xl p-6 card-hover">
        <form method="POST" action="{{ route('finances.update', $entry->id) }}" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                    <input type="date" name="date" max="{{ now()->toDateString() }}"
                           value="{{ old('date', $entry->date->toDateString()) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 input-focus transition-all" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                    <select name="method" class="w-full px-4 py-3 rounded-lg border border-gray-300 input-focus transition-all" required>
                        <option value="cash" {{ old('method', $entry->method) == 'cash' ? 'selected' : '' }}>💵 Cash</option>
                        <option value="gpay" {{ old('method', $entry->method) == 'gpay' ? 'selected' : '' }}>📱 GPay</option>
                    </select>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <input type="text" name="description" value="{{ old('description', $entry->description) }}"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 input-focus transition-all" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select name="category" class="w-full px-4 py-3 rounded-lg border border-gray-300 input-focus transition-all">
                    <option value="">Select Category</option>
                    <option value="Food" {{ old('category', $entry->category) == 'Food' ? 'selected' : '' }}>🍔 Food</option>
                    <option value="Shopping" {{ old('category', $entry->category) == 'Shopping' ? 'selected' : '' }}>🛍️ Shopping</option>
                    <option value="Transport" {{ old('category', $entry->category) == 'Transport' ? 'selected' : '' }}>🚗 Transport</option>
                    <option value="Entertainment" {{ old('category', $entry->category) == 'Entertainment' ? 'selected' : '' }}>🎬 Entertainment</option>
                    <option value="Bills" {{ old('category', $entry->category) == 'Bills' ? 'selected' : '' }}>📄 Bills</option>
                    <option value="Salary" {{ old('category', $entry->category) == 'Salary' ? 'selected' : '' }}>💰 Salary</option>
                    <option value="Other" {{ old('category', $entry->category) == 'Other' ? 'selected' : '' }}>📦 Other</option>
                </select>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Income Amount</label>
                    <input type="number" step="0.01" name="income" value="{{ old('income', $entry->income) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 input-focus transition-all">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Expense Amount</label>
                    <input type="number" step="0.01" name="expense" value="{{ old('expense', $entry->expense) }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 input-focus transition-all">
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <button type="submit" class="btn-primary text-white py-3 px-8 rounded-lg font-semibold transition-all flex-1">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
                <a href="{{ route('finances.index') }}" 
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-8 rounded-lg font-semibold transition-all text-center flex-1">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    .animate-shake {
        animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
</style>
@endsection