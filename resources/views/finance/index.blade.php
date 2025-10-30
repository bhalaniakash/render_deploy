@extends('layouts.app')

@section('title', 'Finance Dashboard')
@section('page-title', 'Financial Overview')
@section('subtitle', 'Track your income, expenses, and balances')

@section('content')
    <div class="animate-fade-in">
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    showToast(@json(session('success')), 'success');
                });
            </script>
        @endif

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="stats-card rounded-xl p-4 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-xs font-medium">Total Balance</p>
                        <p class="text-xl font-bold text-gray-800">₹{{ number_format($finalBalance, 2) }}</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-wallet text-blue-600 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="stats-card rounded-xl p-4 shadow-lg" style="border-left-color: #10b981;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-xs font-medium">Total Income</p>
                        <p class="text-xl font-bold text-gray-800">₹{{ number_format($totalIncome, 2) }}</p>
                    </div>
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-arrow-up text-green-600 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="stats-card rounded-xl p-4 shadow-lg" style="border-left-color: #ef4444;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-xs font-medium">Total Expense</p>
                        <p class="text-xl font-bold text-gray-800">₹{{ number_format($totalExpense, 2) }}</p>
                    </div>
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-arrow-down text-red-600 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="stats-card rounded-xl p-4 shadow-lg" style="border-left-color: #f59e0b;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-xs font-medium">Net Savings</p>
                        <p class="text-xl font-bold text-gray-800">₹{{ number_format($totalIncome - $totalExpense, 2) }}</p>
                    </div>
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-piggy-bank text-yellow-600 text-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Entry Form -->
        <div class="glass-effect rounded-xl p-4 md:p-6 mb-6 card-hover">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-plus-circle text-primary mr-2"></i>
                Add New Transaction
            </h3>

            <form id="add-transaction-form" method="POST" action="{{ route('finances.store') }}" class="space-y-4">
                @csrf
                <div id="form-error" style="display:none" class="errors"></div>

                <!-- Mobile Layout (Stacked) -->
                <div class="block md:hidden space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="date" name="date" max="{{ now()->toDateString() }}"
                                value="{{ old('date', now()->toDateString()) }}"
                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <input type="text" name="description" value="{{ old('description') }}"
                                placeholder="e.g. Lunch at Restaurant"
                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"
                                required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Method</label>
                            <select name="method"
                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"
                                required>
                                <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>💵 Cash</option>
                                <option value="gpay" {{ old('method') == 'gpay' ? 'selected' : '' }}>📱 GPay</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="category"
                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">
                                <option value="">Select</option>
                                <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>🍔 Food</option>
                                <option value="Shopping" {{ old('category') == 'Shopping' ? 'selected' : '' }}>🛍️ Shopping
                                </option>
                                <option value="Transport" {{ old('category') == 'Transport' ? 'selected' : '' }}>🚗
                                    Transport</option>
                                <option value="Entertainment" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>🎬
                                    Entertainment</option>
                                <option value="Bills" {{ old('category') == 'Bills' ? 'selected' : '' }}>📄 Bills</option>
                                <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>💰 Salary
                                </option>
                                <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>📦 Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Income</label>
                            <input type="number" step="0.01" name="income" value="{{ old('income') }}"
                                placeholder="0.00"
                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Expense</label>
                            <input type="number" step="0.01" name="expense" value="{{ old('expense') }}"
                                placeholder="0.00"
                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full btn-primary text-white py-2 px-4 rounded-lg font-semibold transition-all text-sm">
                            <i class="fas fa-plus mr-1"></i> Add Transaction
                        </button>
                    </div>
                </div>

                <!-- Desktop Layout (Grid) -->
                <div class="hidden md:grid md:grid-cols-7 gap-3 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" name="date" max="{{ now()->toDateString() }}"
                            value="{{ old('date', now()->toDateString()) }}"
                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"
                            required>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <input type="text" name="description" value="{{ old('description') }}"
                            placeholder="e.g. Lunch at Restaurant"
                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Method</label>
                        <select name="method"
                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"
                            required>
                            <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>💵 Cash</option>
                            <option value="gpay" {{ old('method') == 'gpay' ? 'selected' : '' }}>📱 GPay</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category"
                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">
                            <option value="">Select</option>
                            <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>🍔 Food</option>
                            <option value="Shopping" {{ old('category') == 'Shopping' ? 'selected' : '' }}>🛍️ Shopping
                            </option>
                            <option value="Transport" {{ old('category') == 'Transport' ? 'selected' : '' }}>🚗 Transport
                            </option>
                            <option value="Entertainment" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>🎬
                                Entertainment</option>
                            <option value="Bills" {{ old('category') == 'Bills' ? 'selected' : '' }}>📄 Bills</option>
                            <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>💰 Salary</option>
                            <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>📦 Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Income</label>
                        <input type="number" step="0.01" name="income" value="{{ old('income') }}"
                            placeholder="0.00"
                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Expense</label>
                        <input type="number" step="0.01" name="expense" value="{{ old('expense') }}"
                            placeholder="0.00"
                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full btn-primary text-white py-2 px-3 rounded-lg font-semibold transition-all text-sm">
                            <i class="fas fa-plus mr-1"></i> Add
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Opening Balance Card -->
        <div class="glass-effect rounded-xl p-4 md:p-6 mb-6 card-hover">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-balance-scale text-primary mr-2"></i>
                Set Opening Balance
            </h3>

            <form method="POST" action="{{ route('finances.opening') }}"
                class="space-y-3 md:space-y-0 md:flex md:items-end md:gap-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:flex-1">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                        <input type="number" step="0.01" name="amount" placeholder="0.00"
                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Method</label>
                        <select name="method"
                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"
                            required>
                            <option value="cash">💵 Cash</option>
                            <option value="gpay">📱 GPay</option>
                        </select>
                    </div>

                    <div class="md:flex md:items-end">
                        <button type="submit"
                            class="w-full bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-lg font-semibold transition-all text-sm">
                            <i class="fas fa-save mr-1"></i>Set Balance
                        </button>
                    </div>
                </div>
            </form>
            <p class="text-gray-600 text-xs mt-3">
                💡 Set opening balance (positive for income, negative for expense)
            </p>
        </div>

        <!-- Transactions Table -->
        <div class="glass-effect rounded-xl p-4 md:p-6 card-hover">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center mb-2 sm:mb-0">
                    <i class="fas fa-list-alt text-primary mr-2"></i>
                    Transaction History
                </h3>
                <div class="text-sm text-gray-600">
                    Total Records: {{ $finances->count() }}
                </div>
            </div>

            @if ($finances->count() > 0)
                <div class="overflow-x-auto rounded-lg">
                    <table class="w-full min-w-full">
                        <thead>
                            <tr class="bg-gray-50/80">
                                <th
                                    class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Date</th>
                                <th
                                    class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Description</th>
                                <th
                                    class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Method</th>
                                <th
                                    class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Category</th>
                                <th
                                    class="px-3 py-2 text-right text-xs font-semibold text-green-600 uppercase tracking-wider">
                                    Income</th>
                                <th
                                    class="px-3 py-2 text-right text-xs font-semibold text-red-600 uppercase tracking-wider">
                                    Expense</th>
                                <th
                                    class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Cash Bal</th>
                                <th
                                    class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    GPay Bal</th>
                                <th
                                    class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Total Bal</th>
                                <th
                                    class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($finances as $f)
                                <tr class="finance-row table-row-hover transition-all duration-200 hover:bg-blue-50/50">
                                    <td class="px-3 py-2 text-xs text-gray-700 whitespace-nowrap">
                                        {{ $f->date->format('d/m/Y') }}</td>
                                    <td class="px-3 py-2 text-xs font-medium text-gray-900 max-w-[120px] truncate"
                                        title="{{ $f->description }}">
                                        {{ $f->description }}
                                    </td>
                                    <td class="px-3 py-2 text-xs whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                                        {{ $f->method == 'cash' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $f->method == 'cash' ? '💵 Cash' : '📱 GPay' }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2 text-xs text-gray-700 whitespace-nowrap">
                                        @if ($f->category)
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-800">
                                                {{ $f->category }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 text-xs text-right font-medium text-green-600 whitespace-nowrap">
                                        {{ $f->income > 0 ? '₹' . number_format($f->income, 2) : '-' }}
                                    </td>
                                    <td class="px-3 py-2 text-xs text-right font-medium text-red-600 whitespace-nowrap">
                                        {{ $f->expense > 0 ? '₹' . number_format($f->expense, 2) : '-' }}
                                    </td>
                                    <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">
                                        ₹{{ number_format($f->cash_balance, 2) }}</td>
                                    <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">
                                        ₹{{ number_format($f->gpay_balance, 2) }}</td>
                                    <td class="px-3 py-2 text-xs text-right font-semibold text-gray-900 whitespace-nowrap">
                                        ₹{{ number_format($f->balance, 2) }}</td>
                                    <td class="px-3 py-2 text-xs text-right whitespace-nowrap">
                                        <div class="flex justify-end space-x-1">
                                            <a href="{{ route('finances.edit', $f->id) }}"
                                                class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs hover:bg-blue-200 transition-colors">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <form method="POST" action="{{ route('finances.destroy', $f->id) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this entry?')"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded text-xs hover:bg-red-200 transition-colors">
                                                    <i class="fas fa-trash mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50/80 font-semibold">
                            <tr>
                                <td colspan="4" class="px-3 py-2 text-xs text-gray-700 whitespace-nowrap">Final Totals
                                </td>
                                <td class="px-3 py-2 text-xs text-right text-green-600 whitespace-nowrap">
                                    ₹{{ number_format($totalIncome, 2) }}</td>
                                <td class="px-3 py-2 text-xs text-right text-red-600 whitespace-nowrap">
                                    ₹{{ number_format($totalExpense, 2) }}</td>
                                <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">
                                    ₹{{ number_format($finalCashBalance ?? 0, 2) }}</td>
                                <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">
                                    ₹{{ number_format($finalGpayBalance ?? 0, 2) }}</td>
                                <td class="px-3 py-2 text-xs text-right text-gray-900 whitespace-nowrap">
                                    ₹{{ number_format($finalBalance, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-receipt text-3xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500 text-sm">No transactions yet</p>
                    <p class="text-gray-400 text-xs mt-1">Add your first transaction to get started!</p>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
        <style>
            @media (max-width: 768px) {
                .overflow-x-auto {
                    -webkit-overflow-scrolling: touch;
                }

                table {
                    font-size: 0.75rem;
                }

                .finance-row td {
                    padding: 0.5rem 0.25rem;
                }
            }

            /* Ensure table is properly scrollable on mobile */
            .overflow-x-auto {
                overflow-x: auto;
                width: 100%;
            }

            /* Fix for small screens */
            @media (max-width: 640px) {
                .stats-card {
                    padding: 0.75rem;
                }

                .stats-card p.text-xl {
                    font-size: 1.125rem;
                }

                .glass-effect {
                    padding: 1rem;
                }
            }

            .errors {
                background: #fff5f5;
                border: 1px solid rgba(239, 68, 68, 0.12);
                color: var(--danger);
                padding: 10px;
                border-radius: 6px;
                margin-bottom: 12px
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Auto-format currency inputs
                const incomeInput = document.querySelector('input[name="income"]');
                const expenseInput = document.querySelector('input[name="expense"]');
                const amountInput = document.querySelector('input[name="amount"]');

                function formatCurrencyInput(input) {
                    input.addEventListener('blur', function() {
                        if (this.value) {
                            this.value = parseFloat(this.value).toFixed(2);
                        }
                    });
                }

                if (incomeInput) formatCurrencyInput(incomeInput);
                if (expenseInput) formatCurrencyInput(expenseInput);
                if (amountInput) formatCurrencyInput(amountInput);

                // Ensure only one of income/expense is filled
                function validateAmounts() {
                    if (incomeInput && expenseInput) {
                        if (incomeInput.value && expenseInput.value) {
                            expenseInput.value = '';
                        }
                    }
                }

                if (incomeInput) incomeInput.addEventListener('input', validateAmounts);
                if (expenseInput) expenseInput.addEventListener('input', validateAmounts);
            });
        </script>
    @endpush
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('add-transaction-form');
            if (!form) return;
            const income = form.querySelector('input[name="income"]');
            const expense = form.querySelector('input[name="expense"]');
            const method = form.querySelector('select[name="method"]');
            const errorDiv = document.getElementById('form-error');

            form.addEventListener('submit', function(e) {
                // Clear previous error
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                    errorDiv.innerHTML = '';
                }

                // Ensure method selected
                if (method && !method.value) {
                    e.preventDefault();
                    if (errorDiv) {
                        errorDiv.style.display = 'block';
                        errorDiv.innerText = 'Please select a payment method.';
                    }
                    return false;
                }

                const inc = parseFloat(income?.value || 0);
                const exp = parseFloat(expense?.value || 0);
                if ((!inc || inc <= 0) && (!exp || exp <= 0)) {
                    e.preventDefault();
                    if (errorDiv) {
                        errorDiv.style.display = 'block';
                        errorDiv.innerText = 'Enter an amount for Income or Expense.';
                    }
                    return false;
                }
            });
        });
    </script>
@endpush
