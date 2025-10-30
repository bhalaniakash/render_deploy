@extends('layouts.app')@extends('layouts.app')@extends('layouts.app')



@section('title', 'Finance Dashboard')

@section('page-title', 'Financial Overview')

@section('subtitle', 'Track your income, expenses, and balances')@section('title', 'Finance Dashboard')@section('title', 'Finance Dashboard')



@section('content')@section('page-title', 'Financial Overview')@section('page-title', 'Financial Overview')

<div class="animate-fade-in">

    @if (session('success'))@section('subtitle', 'Track your income, expenses, and balances')@section('subtitle', 'Track your income, expenses, and

        <script>balances')

            document.addEventListener('DOMContentLoaded', () => {

                showToast(@json(session('success')), 'success');

            });

        </script>@section('content')@section('content')

    @endif

<div class="animate-fade-in">

    @if ($errors->any())    <div class="animate-fade-in">

        <div class="errors">

            <ul>        @if (session('success'))

                @foreach ($errors->all() as $err)            @if (session('success'))

                    <li>{{ $err }}</li>

                @endforeach                <script>

            </ul>                    < script >

        </div>

    @endif                        document.addEventListener('DOMContentLoaded', () => {

                            document.addEventListener('DOMContentLoaded', () => {

    <!-- Quick Stats -->

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">                                showToast(@json(session('success')), 'success');

        <div class="stats-card rounded-xl p-4 shadow-lg">                                showToast(@json(session('success')), 'success');

            <div class="flex items-center justify-between">

                <div>                            });

                    <p class="text-gray-600 text-xs font-medium">Total Balance</p>                        });

                    <p class="text-xl font-bold text-gray-800">₹{{ number_format($finalBalance, 2) }}</p>                </script>

                </div>                </script>

                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">

                    <i class="fas fa-wallet text-blue-600 text-lg"></i>            @endif

                </div>        @endif

            </div>

        </div>



        <div class="stats-card rounded-xl p-4 shadow-lg" style="border-left-color: #10b981;">        @if ($errors->any())

            <div class="flex items-center justify-between">            @if ($errors->any())

                <div>

                    <p class="text-gray-600 text-xs font-medium">Total Income</p>                <div class="errors">

                    <p class="text-xl font-bold text-gray-800">₹{{ number_format($totalIncome, 2) }}</p>                    <script>

                </div>                        < ul > // Robustly pick the visible control when there are duplicate inputs

                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">

                    <i class="fas fa-arrow-up text-green-600 text-lg"></i>                            @foreach ($errors->all() as $err) // (mobile + desktop variants). For each named control group we enable

                </div>

            </div>                                <

        </div>                                li > {{ $err }} < /li>                / /

                                    only the visible instance so browser validation targets a focusable

        <div class="stats-card rounded-xl p-4 shadow-lg" style="border-left-color: #ef4444;">                            @endforeach // element. Hidden inputs (like CSRF token) are left untouched.

            <div class="flex items-center justify-between">

                <div>                            <

                    <p class="text-gray-600 text-xs font-medium">Total Expense</p>                            /ul>                (function() {

                    <p class="text-xl font-bold text-gray-800">₹{{ number_format($totalExpense, 2) }}</p>

                </div>                            <

                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">                            /div>                    function isVisible(el) {

                    <i class="fas fa-arrow-down text-red-600 text-lg"></i>                        @endif

                </div>                        if (!el) return false;

            </div>

        </div>                        if (el.type === 'hidden') return false; // treat hidden as not visible for selection



        <div class="stats-card rounded-xl p-4 shadow-lg" style="border-left-color: #f59e0b;">                        <

            <div class="flex items-center justify-between">                        !--Quick Stats-- >

                <div>                        const style = window.getComputedStyle(el);

                    <p class="text-gray-600 text-xs font-medium">Net Savings</p>

                    <p class="text-xl font-bold text-gray-800">₹{{ number_format($totalIncome - $totalExpense, 2) }}</p>                        <

                </div>                        div class = "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8" >

                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">                        if (style.display === 'none' || style.visibility === 'hidden' || style.opacity === '0') return false;

                    <i class="fas fa-piggy-bank text-yellow-600 text-lg"></i>

                </div>                        <

            </div>                        div class = "stats-card rounded-xl p-4 shadow-lg" >

        </div>                        const rects = el.getClientRects();

    </div>

                        <

    <!-- Add Entry Form -->                        div class = "flex items-center justify-between" >

    <div class="glass-effect rounded-xl p-4 md:p-6 mb-6 card-hover">                        return rects.length > 0 && rects[0].width > 0 && rects[0].height > 0;

        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">

            <i class="fas fa-plus-circle text-primary mr-2"></i>                        <

            Add New Transaction                        div >

        </h3>                        }



        <form id="add-transaction-form" method="POST" action="{{ route('finances.store') }}" class="space-y-4">                        <

            @csrf                        p class = "text-gray-600 text-xs font-medium" > Total Balance < /p>

            <div id="form-error" style="display:none" class="errors"></div>

                            <

            <!-- Mobile Layout (Stacked) -->                            p class = "text-xl font-bold text-gray-800" > ₹{{ number_format($finalBalance, 2) }} <

            <div class="block md:hidden space-y-4">                            /p>                    function syncFormControls(form) {

                <div class="grid grid-cols-1 gap-4">

                    <div>                            <

                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>                            /div>                        if (!form) return;

                        <input type="date" name="date" max="{{ now()->toDateString() }}"

                            value="{{ old('date', now()->toDateString()) }}"                            <

                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"                            div class = "w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center" >

                            required>                            const named = {};

                    </div>

                        <

                    <div>                        i class = "fas fa-wallet text-blue-600 text-lg" > <

                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>                        /i>                        form.querySelectorAll('input[name],select[name],textarea[name]').forEach(el => {

                        <input type="text" name="description" value="{{ old('description') }}"

                            placeholder="e.g. Lunch at Restaurant"                        <

                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"                        /div>                            / / never touch true hidden inputs(csrf etc.)

                            required>

                    </div>                            <

                </div>                            /div>                            if (el.type === 'hidden') return;



                <div class="grid grid-cols-2 gap-4">                            <

                    <div>                            /div>                            if (el.matches('button,input[type="submit"],input[type="button"]')) return;

                        <label class="block text-sm font-medium text-gray-700 mb-1">Method</label>

                        <select name="method"                        const name = el.getAttribute('name');

                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"

                            required>                        <

                            <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>💵 Cash</option>                        div class = "stats-card rounded-xl p-4 shadow-lg"

                            <option value="gpay" {{ old('method') == 'gpay' ? 'selected' : '' }}>📱 GPay</option>                        style = "border-left-color: #10b981;" >

                        </select>                            if (!name) return;

                    </div>

                        <

                    <div>                        div class = "flex items-center justify-between" > named[name] = named[name] || [];

                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>

                        <select name="category"                        <

                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">                        div > named[name].push(el);

                            <option value="">Select</option>

                            <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>🍔 Food</option>                        <

                            <option value="Shopping" {{ old('category') == 'Shopping' ? 'selected' : '' }}>🛍️ Shopping</option>                        p class = "text-gray-600 text-xs font-medium" > Total Income < /p>                        });

                            <option value="Transport" {{ old('category') == 'Transport' ? 'selected' : '' }}>🚗 Transport</option>

                            <option value="Entertainment" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>🎬 Entertainment</option>                            <

                            <option value="Bills" {{ old('category') == 'Bills' ? 'selected' : '' }}>📄 Bills</option>                            p class = "text-xl font-bold text-gray-800" > ₹{{ number_format($totalIncome, 2) }} < /p>

                            <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>💰 Salary</option>

                            <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>📦 Other</option>                            <

                        </select>                            /div>                        Object.keys(named).forEach(name => {

                    </div>

                </div>                            <

                            div class = "w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center" >

                <div class="grid grid-cols-2 gap-4">                            const group = named[name];

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">Income</label>                        <

                        <input type="number" step="0.01" name="income" value="{{ old('income') }}"                        i class = "fas fa-arrow-up text-green-600 text-lg" > < /i>                            / / find a visible control;

                            placeholder="0.00"                        if none visible, use the first one

                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">

                    </div>                            <

                            /div>                            const visible = group.find(isVisible) || group[0];

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">Expense</label>                            <

                        <input type="number" step="0.01" name="expense" value="{{ old('expense') }}"                            /div>                            group.forEach(el => {

                            placeholder="0.00"

                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">                            <

                    </div>                            /div>                                if (el === visible) {

                </div>

                        el.removeAttribute('disabled');

                <div>

                    <button type="submit"                        <

                        class="w-full btn-primary text-white py-2 px-4 rounded-lg font-semibold transition-all text-sm">                        div class = "stats-card rounded-xl p-4 shadow-lg"

                        <i class="fas fa-plus mr-1"></i> Add Transaction                        style = "border-left-color: #ef4444;" >

                    </button>                        }

                </div>                        else {

            </div>

                            <

            <!-- Desktop Layout (Grid) -->                            div class = "flex items-center justify-between" > el.setAttribute('disabled', 'disabled');

            <div class="hidden md:grid md:grid-cols-7 gap-3 items-end">

                <div>                            <

                    <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>                            div >

                    <input type="date" name="date" max="{{ now()->toDateString() }}"                        }

                        value="{{ old('date', now()->toDateString()) }}"

                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"                        <

                        required>                        p class = "text-gray-600 text-xs font-medium" > Total Expense < /p>                            });

                </div>

                            <

                <div class="col-span-2">                            p class = "text-xl font-bold text-gray-800" > ₹{{ number_format($totalExpense, 2) }} <

                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>                            /p>                        });

                    <input type="text" name="description" value="{{ old('description') }}"

                        placeholder="e.g. Lunch at Restaurant"                            <

                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"                            /div>                    }

                        required>

                </div>                            <

                            div class = "w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center" >

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">Method</label>                            <

                    <select name="method"                            i class = "fas fa-arrow-down text-red-600 text-lg" > <

                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"                            /i>                    const addForm = document.getElementById('add-transaction-form');

                        required>

                        <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>💵 Cash</option>                            <

                        <option value="gpay" {{ old('method') == 'gpay' ? 'selected' : '' }}>📱 GPay</option>                            /div>                    if (addForm) {

                    </select>

                </div>                            <

                            /div>                        / / initial sync

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>                            <

                    <select name="category"                            /div>                        syncFormControls(addForm);

                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">

                        <option value="">Select</option>

                        <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>🍔 Food</option>

                        <option value="Shopping" {{ old('category') == 'Shopping' ? 'selected' : '' }}>🛍️ Shopping</option>                            <

                        <option value="Transport" {{ old('category') == 'Transport' ? 'selected' : '' }}>🚗 Transport</option>                            div class = "stats-card rounded-xl p-4 shadow-lg"

                        <option value="Entertainment" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>🎬 Entertainment</option>                        style = "border-left-color: #f59e0b;" > // re-sync on resize/orientation change (debounced)

                        <option value="Bills" {{ old('category') == 'Bills' ? 'selected' : '' }}>📄 Bills</option>

                        <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>💰 Salary</option>                            <

                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>📦 Other</option>                            div class = "flex items-center justify-between" >

                    </select>                            let t = null;

                </div>

                        <

                <div>                        div > window.addEventListener('resize', function() {

                    <label class="block text-sm font-medium text-gray-700 mb-1">Income</label>

                    <input type="number" step="0.01" name="income" value="{{ old('income') }}"                        <

                        placeholder="0.00"                        p class = "text-gray-600 text-xs font-medium" > Net Savings <

                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">                        /p>                            clearTimeout(t);

                </div>

                        <

                <div>                        p class = "text-xl font-bold text-gray-800" > ₹

                    <label class="block text-sm font-medium text-gray-700 mb-1">Expense</label>                        {{ number_format($totalIncome - $totalExpense, 2) }} <

                    <input type="number" step="0.01" name="expense" value="{{ old('expense') }}"                        /p>                            t = setTimeout(function() {

                        placeholder="0.00"

                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">                        <

                </div>                        /div>                                syncFormControls(addForm);



                <div>                        <

                    <button type="submit"                        div class = "w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center" >

                        class="w-full btn-primary text-white py-2 px-3 rounded-lg font-semibold transition-all text-sm">                        }, 120);

                        <i class="fas fa-plus mr-1"></i> Add

                    </button>                        <

                </div>                        i class = "fas fa-piggy-bank text-yellow-600 text-lg" > < /i>                        });

            </div>

        </form>                        <

    </div>                        /div>                        window.addEventListener('orientationchange', function() {



    <!-- Opening Balance Card -->                        <

    <div class="glass-effect rounded-xl p-4 md:p-6 mb-6 card-hover">                        /div>                            setTimeout(function() {

        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">

            <i class="fas fa-balance-scale text-primary mr-2"></i>                        <

            Set Opening Balance                        /div>                                syncFormControls(addForm);

        </h3>

                        <

        <form method="POST" action="{{ route('finances.opening') }}"                        /div>                            }, 150);

            class="space-y-3 md:space-y-0 md:flex md:items-end md:gap-4">

            @csrf                        });

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:flex-1">

                <div>                        <

                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>                        !--Add Entry Form-- >

                    <input type="number" step="0.01" name="amount" placeholder="0.00"                        }

                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">

                </div>                        <

                        div class = "glass-effect rounded-xl p-4 md:p-6 mb-6 card-hover" >

                <div>                        })();

                    <label class="block text-sm font-medium text-gray-700 mb-1">Method</label>

                    <select name="method"                        <

                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"                        h3 class = "text-lg font-semibold text-gray-800 mb-4 flex items-center" >

                        required>                    </script>

                        <option value="cash">💵 Cash</option>

                        <option value="gpay">📱 GPay</option>                    <i class="fas fa-plus-circle text-primary mr-2"></i>

                    </select>                    <div>

                </div>

                        Add New Transaction <p class="text-gray-600 text-xs font-medium">Net Savings</p>

                <div class="md:flex md:items-end">

                    <button type="submit"                        </h3>

                        class="w-full bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-lg font-semibold transition-all text-sm">                        <p class="text-xl font-bold text-gray-800">₹{{ number_format($totalIncome - $totalExpense, 2) }}

                        <i class="fas fa-save mr-1"></i>Set Balance                        </p>

                    </button>

                </div>                    </div>

            </div>

        </form>                    <form id="add-transaction-form" method="POST" action="{{ route('finances.store') }}" class="space-y-4">

        <p class="text-gray-600 text-xs mt-3">                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">

            💡 Set opening balance (positive for income, negative for expense)

        </p>                            @csrf <i class="fas fa-piggy-bank text-yellow-600 text-lg"></i>

    </div>

                            <div id="form-error" style="display:none" class="errors"></div>

    <!-- Transactions Table -->                        </div>

    <div class="glass-effect rounded-xl p-4 md:p-6 card-hover">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">                </div>

            <h3 class="text-lg font-semibold text-gray-800 flex items-center mb-2 sm:mb-0">

                <i class="fas fa-list-alt text-primary mr-2"></i>                <!-- Mobile Layout (Stacked) -->

                Transaction History    </div>

            </h3>

            <div class="text-sm text-gray-600">    <div class="block md:hidden space-y-4"> </div>

                Total Records: {{ $finances->count() }}

            </div>    <div class="grid grid-cols-1 gap-4">

        </div>

        <div> <!-- Add Entry Form -->

        @if ($finances->count() > 0)

            <div class="overflow-x-auto rounded-lg">            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>

                <table class="w-full min-w-full">            <div class="glass-effect rounded-xl p-4 md:p-6 mb-6 card-hover">

                    <thead>

                        <tr class="bg-gray-50/80">                <input type="date" name="date" max="{{ now()->toDateString() }}" <h3

                            <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Date</th>                    class="text-lg font-semibold text-gray-800 mb-4 flex items-center">

                            <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Description</th>

                            <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Method</th>                value="{{ old('date', now()->toDateString()) }}" <i class="fas fa-plus-circle text-primary mr-2"></i>

                            <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Category</th>

                            <th class="px-3 py-2 text-right text-xs font-semibold text-green-600 uppercase tracking-wider">Income</th>                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all" Add New

                            <th class="px-3 py-2 text-right text-xs font-semibold text-red-600 uppercase tracking-wider">Expense</th>                Transaction

                            <th class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Cash Bal</th>

                            <th class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">GPay Bal</th>                required> </h3>

                            <th class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Total Bal</th>

                            <th class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>            </div>

                        </tr>

                    </thead>            <form id="add-transaction-form" method="POST" action="{{ route('finances.store') }}" class="space-y-4">

                    <tbody class="divide-y divide-gray-200">

                        @foreach ($finances as $f)                <div> @csrf

                            <tr class="finance-row table-row-hover transition-all duration-200 hover:bg-blue-50/50">

                                <td class="px-3 py-2 text-xs text-gray-700 whitespace-nowrap">{{ $f->date->format('d/m/Y') }}</td>                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>

                                <td class="px-3 py-2 text-xs font-medium text-gray-900 max-w-[120px] truncate" title="{{ $f->description }}">{{ $f->description }}</td>                    <div id="form-error" style="display:none" class="errors"></div>

                                <td class="px-3 py-2 text-xs whitespace-nowrap">

                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $f->method == 'cash' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' }}">                    <input type="text" name="description" value="{{ old('description') }}"

                                        {{ $f->method == 'cash' ? '💵 Cash' : '📱 GPay' }}                        placeholder="e.g. Lunch at Restaurant" <!-- Mobile Layout (Stacked) -->

                                    </span>

                                </td>                    class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all" <div

                                <td class="px-3 py-2 text-xs text-gray-700 whitespace-nowrap">                        class="block md:hidden space-y-4">

                                    @if ($f->category)

                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-800">{{ $f->category }}</span>                        required> <div class="grid grid-cols-1 gap-4">

                                    @else

                                        <span class="text-gray-400">-</span>                        </div>

                                    @endif                        <div>

                                </td>

                                <td class="px-3 py-2 text-xs text-right font-medium text-green-600 whitespace-nowrap">{{ $f->income > 0 ? '₹' . number_format($f->income, 2) : '-' }}</td>                        </div> <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>

                                <td class="px-3 py-2 text-xs text-right font-medium text-red-600 whitespace-nowrap">{{ $f->expense > 0 ? '₹' . number_format($f->expense, 2) : '-' }}</td>

                                <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">₹{{ number_format($f->cash_balance, 2) }}</td>                        <input type="date" name="date" max="{{ now()->toDateString() }}" <div

                                <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">₹{{ number_format($f->gpay_balance, 2) }}</td>                            class="grid grid-cols-2 gap-4"> value="{{ old('date', now()->toDateString()) }}"

                                <td class="px-3 py-2 text-xs text-right font-semibold text-gray-900 whitespace-nowrap">₹{{ number_format($f->balance, 2) }}</td>

                                <td class="px-3 py-2 text-xs text-right whitespace-nowrap">                        <div>

                                    <div class="flex justify-end space-x-1">                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"

                                        <a href="{{ route('finances.edit', $f->id) }}" class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs hover:bg-blue-200 transition-colors">

                                            <i class="fas fa-edit mr-1"></i> Edit                            <label class="block text-sm font-medium text-gray-700 mb-1">Method</label> required>

                                        </a>

                                        <form method="POST" action="{{ route('finances.destroy', $f->id) }}" onsubmit="return confirm('Are you sure?')" class="inline">                            <select name="method" </div>

                                            @csrf

                                            @method('DELETE')                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"

                                            <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded text-xs hover:bg-red-200 transition-colors">

                                                <i class="fas fa-trash mr-1"></i> Delete                                required> <div>

                                            </button>

                                        </form>                                    <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>💵 Cash

                                    </div>                                    </option> <label

                                </td>                                        class="block text-sm font-medium text-gray-700 mb-1">Description</label>

                            </tr>

                        @endforeach                                    <option value="gpay" {{ old('method') == 'gpay' ? 'selected' : '' }}>📱 GPay

                    </tbody>                                    </option> <input type="text" name="description" value="{{ old('description') }}"

                    <tfoot class="bg-gray-50/80 font-semibold">                                        </select> placeholder="e.g. Lunch at Restaurant"

                        <tr>

                            <td colspan="4" class="px-3 py-2 text-xs text-gray-700 whitespace-nowrap">Final Totals</td>                                </div>

                            <td class="px-3 py-2 text-xs text-right text-green-600 whitespace-nowrap">₹{{ number_format($totalIncome, 2) }}</td>                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"

                            <td class="px-3 py-2 text-xs text-right text-red-600 whitespace-nowrap">₹{{ number_format($totalExpense, 2) }}</td>

                            <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">₹{{ number_format($finalCashBalance ?? 0, 2) }}</td>                                required>

                            <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">₹{{ number_format($finalGpayBalance ?? 0, 2) }}</td>

                            <td class="px-3 py-2 text-xs text-right text-gray-900 whitespace-nowrap">₹{{ number_format($finalBalance, 2) }}</td>                                <div> </div>

                            <td></td>

                        </tr>                                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>

                    </tfoot>                        </div>

                </table>

            </div>                        <select name="category"

        @else                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">

            <div class="text-center py-8">                            <div class="grid grid-cols-2 gap-4">

                <i class="fas fa-receipt text-3xl text-gray-300 mb-3"></i>

                <p class="text-gray-500 text-sm">No transactions yet</p>                                <option value="">Select</option>

                <p class="text-gray-400 text-xs mt-1">Add your first transaction to get started!</p>                                <div>

            </div>

        @endif                                    <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>🍔 Food

    </div>                                    </option> <label class="block text-sm font-medium text-gray-700 mb-1">Method</label>

</div>

                                    <option value="Shopping" {{ old('category') == 'Shopping' ? 'selected' : '' }}>🛍️

@push('styles')                                        Shopping</option> <select name="method" <option value="Transport"

    <style>                                        {{ old('category') == 'Transport' ? 'selected' : '' }}>🚗 Transport</option>

        .errors {                                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"

            background: #fff5f5;

            border: 1px solid rgba(239, 68, 68, 0.12);                                        <option value="Entertainment"

            color: #ef4444;                                            {{ old('category') == 'Entertainment' ? 'selected' : '' }}>🎬 Entertainment

            padding: 10px;                                        </option> required>

            border-radius: 6px;

            margin-bottom: 12px;                                        <option value="Bills" {{ old('category') == 'Bills' ? 'selected' : '' }}>📄

        }                                            Bills</option>

                                        <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>💵 Cash

        .errors li {                                        </option>

            list-style: disc;

            margin-left: 20px;                                        <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>💰

        }                                            Salary</option>

                                        <option value="gpay" {{ old('method') == 'gpay' ? 'selected' : '' }}>📱 GPay

        @media (max-width: 768px) {                                        </option>

            .overflow-x-auto {

                -webkit-overflow-scrolling: touch;                                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>📦

            }                                            Other</option>

            table {                                    </select>

                font-size: 0.75rem;

            }                        </select>

            .finance-row td {                    </div>

                padding: 0.5rem 0.25rem;

            }                </div>

        }

        </div>

        @media (max-width: 640px) {        <div>

            .stats-card {

                padding: 0.75rem;            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>

            }

            .stats-card p.text-xl {            <div class="grid grid-cols-2 gap-4"> <select name="category" <div>

                font-size: 1.125rem;                    class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">

            }

            .glass-effect {                    <label class="block text-sm font-medium text-gray-700 mb-1">Income</label>

                padding: 1rem;                    <option value="">Select</option>

            }

        }                    <input type="number" step="0.01" name="income" value="{{ old('income') }}" <option

    </style>                        value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>🍔 Food</option>

@endpush

                    placeholder="0.00" <option value="Shopping" {{ old('category') == 'Shopping' ? 'selected' : '' }}>

@push('scripts')                        🛍️ Shopping

    <script>

        document.addEventListener('DOMContentLoaded', function() {                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">

            const form = document.getElementById('add-transaction-form');                    </option>

            if (!form) return;

            </div>

            const income = form.querySelector('input[name="income"]');            <option value="Transport" {{ old('category') == 'Transport' ? 'selected' : '' }}>🚗

            const expense = form.querySelector('input[name="expense"]');

            const method = form.querySelector('select[name="method"]');                Transport</option>

            const errorDiv = document.getElementById('form-error');

            <div>

            // Sync duplicate form controls (mobile/desktop variants)                <option value="Entertainment" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>🎬

            function isVisible(el) {

                if (!el || el.type === 'hidden') return false;                    <label class="block text-sm font-medium text-gray-700 mb-1">Expense</label> Entertainment

                const style = window.getComputedStyle(el);                </option>

                if (style.display === 'none' || style.visibility === 'hidden') return false;

                const rects = el.getClientRects();                <input type="number" step="0.01" name="expense" value="{{ old('expense') }}" <option value="Bills"

                return rects.length > 0 && rects[0].width > 0;                    {{ old('category') == 'Bills' ? 'selected' : '' }}>📄 Bills</option>

            }

                placeholder="0.00" <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>💰 Salary

            function syncControls() {

                const named = {};                    class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">

                form.querySelectorAll('[name]:not([type="hidden"]):not(button)').forEach(el => {                </option>

                    const name = el.getAttribute('name');

                    if (!name) return;            </div>

                    named[name] = named[name] || [];            <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>📦 Other</option>

                    named[name].push(el);

                });        </div> </select>



                Object.values(named).forEach(group => {    </div>

                    const visible = group.find(isVisible) || group[0];

                    group.forEach(el => {    <div> </div>

                        el.toggleAttribute('disabled', el !== visible);

                    });    <button type="submit"

                });        class="w-full btn-primary text-white py-2 px-4 rounded-lg font-semibold transition-all text-sm">

            }        <div class="grid grid-cols-2 gap-4">



            syncControls();            <i class="fas fa-plus mr-1"></i> Add Transaction <div>

            let timer;

            window.addEventListener('resize', () => {    </button> <label class="block text-sm font-medium text-gray-700 mb-1">Income</label>

                clearTimeout(timer);

                timer = setTimeout(syncControls, 150);</div> <input type="number" step="0.01" name="income" value="{{ old('income') }}" placeholder="0.00" </div>

            });class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">



            // Form validation</div>

            form.addEventListener('submit', function(e) {

                if (errorDiv) {<!-- Desktop Layout (Grid) -->

                    errorDiv.style.display = 'none';

                    errorDiv.innerHTML = '';<div class="hidden md:grid md:grid-cols-7 gap-3 items-end">

                }    <div>



                if (!method || !method.value) {        <div> <label class="block text-sm font-medium text-gray-700 mb-1">Expense</label>

                    e.preventDefault();

                    if (errorDiv) {            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label> <input type="number"

                        errorDiv.style.display = 'block';                step="0.01" name="expense" value="{{ old('expense') }}" placeholder="0.00" <input

                        errorDiv.innerHTML = '<ul><li>Please select a payment method.</li></ul>';                type="date" name="date" max="{{ now()->toDateString() }}"

                    }                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">

                    return false;

                }            value="{{ old('date', now()->toDateString()) }}"

        </div>

                const inc = parseFloat(income?.value || 0);

                const exp = parseFloat(expense?.value || 0);        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"

                if ((!inc || inc <= 0) && (!exp || exp <= 0)) {    </div>

                    e.preventDefault();

                    if (errorDiv) {    required>

                        errorDiv.style.display = 'block';

                        errorDiv.innerHTML = '<ul><li>Enter income or expense amount.</li></ul>';</div>

                    }<div>

                    return false;

                }    <button type="submit" <div class="col-span-2">

            });        class="w-full btn-primary text-white py-2 px-4 rounded-lg font-semibold transition-all text-sm">



            // Auto-format currency        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label> <i

            [income, expense].forEach(input => {            class="fas fa-plus mr-1"></i> Add Transaction

                if (input) {

                    input.addEventListener('blur', function() {        <input type="text" name="description" value="{{ old('description') }}" </button>

                        if (this.value) this.value = parseFloat(this.value).toFixed(2);

                    });        placeholder="e.g. Lunch at Restaurant"

                }</div>

            });

        });class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all" </div>

    </script>

@endpushrequired>

@endsection

</div> <!-- Desktop Layout (Grid) -->

<div class="hidden md:grid md:grid-cols-7 gap-3 items-end">

    <div>
        <div>

            <label class="block text-sm font-medium text-gray-700 mb-1">Method</label> <label
                class="block text-sm font-medium text-gray-700 mb-1">Date</label>

            <select name="method" <input type="date" name="date" max="{{ now()->toDateString() }}"
                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"
                value="{{ old('date', now()->toDateString()) }}" required>
                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"

                <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>💵 Cash</option> required>

                <option value="gpay" {{ old('method') == 'gpay' ? 'selected' : '' }}>📱 GPay</option>
        </div>

        </select>

    </div>
    <div class="col-span-2">

        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>

        <div> <input type="text" name="description" value="{{ old('description') }}" <label
                class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            placeholder="e.g. Lunch at Restaurant"

            <select name="category"
                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"
                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">
                required>

                <option value="">Select</option>
        </div>

        <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>🍔 Food</option>

        <option value="Shopping" {{ old('category') == 'Shopping' ? 'selected' : '' }}>🛍️ Shopping</option>
        <div>

            <option value="Transport" {{ old('category') == 'Transport' ? 'selected' : '' }}>🚗 Transport</option>
            <label class="block text-sm font-medium text-gray-700 mb-1">Method</label>

            <option value="Entertainment" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>🎬 Entertainment
            </option> <select name="method" <option value="Bills"
                {{ old('category') == 'Bills' ? 'selected' : '' }}>📄 Bills</option>
                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"

                <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>💰 Salary</option>
                required>

                <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>📦 Other</option>
                <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>💵 Cash</option>

            </select>
            <option value="gpay" {{ old('method') == 'gpay' ? 'selected' : '' }}>📱 GPay</option>

        </div> </select>

    </div>

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">Income</label>
        <div>

            <input type="number" step="0.01" name="income" value="{{ old('income') }}" <label
                class="block text-sm font-medium text-gray-700 mb-1">Category</label>

            placeholder="0.00" <select name="category"
                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">
                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">

        </div>
        <option value="">Select</option>

        <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>🍔 Food</option>

        <div>
            <option value="Shopping" {{ old('category') == 'Shopping' ? 'selected' : '' }}>🛍️ Shopping

                <label class="block text-sm font-medium text-gray-700 mb-1">Expense</label>
            </option>

            <input type="number" step="0.01" name="expense" value="{{ old('expense') }}" <option
                value="Transport" {{ old('category') == 'Transport' ? 'selected' : '' }}>🚗 Transport

            placeholder="0.00" </option>

            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"> <option
                value="Entertainment" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>🎬

        </div> Entertainment</option>

        <option value="Bills" {{ old('category') == 'Bills' ? 'selected' : '' }}>📄 Bills</option>

        <div>
            <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>💰 Salary</option>

            <button type="submit" <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>📦 Other
                </option>

                class="w-full btn-primary text-white py-2 px-3 rounded-lg font-semibold transition-all text-sm">
                </select>

                <i class="fas fa-plus mr-1"></i> Add
        </div>

        </button>

    </div>
    <div>

    </div> <label class="block text-sm font-medium text-gray-700 mb-1">Income</label>

    </form> <input type="number" step="0.01" name="income" value="{{ old('income') }}" placeholder="0.00"
        </div> class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">

</div>

<!-- Opening Balance Card -->

<div class="glass-effect rounded-xl p-4 md:p-6 mb-6 card-hover">
    <div>

        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center"> <label
                class="block text-sm font-medium text-gray-700 mb-1">Expense</label>

            <i class="fas fa-balance-scale text-primary mr-2"></i> <input type="number" step="0.01"
                name="expense" value="{{ old('expense') }}" Set Opening Balance placeholder="0.00" </h3>
            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">

    </div>

    <form method="POST" action="{{ route('finances.opening') }}"
        class="space-y-3 md:space-y-0 md:flex md:items-end md:gap-4">
        <div>

            @csrf <button type="submit" <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:flex-1">
                class="w-full btn-primary text-white py-2 px-3 rounded-lg font-semibold transition-all text-sm">

                <div> <i class="fas fa-plus mr-1"></i> Add

                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
            </button>

            <input type="number" step="0.01" name="amount" placeholder="0.00" </div>

            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">
        </div>

</div>
</form>

</div>

<div>

    <label class="block text-sm font-medium text-gray-700 mb-1">Method</label> <!-- Opening Balance Card -->

    <select name="method" <div class="glass-effect rounded-xl p-4 md:p-6 mb-6 card-hover">

        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all" <h3
            class="text-lg font-semibold text-gray-800 mb-4 flex items-center">

            required> <i class="fas fa-balance-scale text-primary mr-2"></i>

            <option value="cash">💵 Cash</option> Set Opening Balance

            <option value="gpay">📱 GPay</option>
        </h3>

    </select>

</div>
<form method="POST" action="{{ route('finances.opening') }}"
    class="space-y-3 md:space-y-0 md:flex md:items-end md:gap-4">

    <div class="md:flex md:items-end"> @csrf

        <button type="submit" <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:flex-1">

            class="w-full bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-lg font-semibold transition-all text-sm">
            <div>

                <i class="fas fa-save mr-1"></i>Set Balance <label
                    class="block text-sm font-medium text-gray-700 mb-1">Amount</label>

        </button> <input type="number" step="0.01" name="amount" placeholder="0.00" </div>
        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all">

    </div>
    </div>

</form>

<p class="text-gray-600 text-xs mt-3">
<div>

    💡 Set opening balance (positive for income, negative for expense) <label
        class="block text-sm font-medium text-gray-700 mb-1">Method</label>

    </p> <select name="method" </div>
        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 input-focus transition-all"

        required>

        <!-- Transactions Table -->
        <option value="cash">💵 Cash</option>

        <div class="glass-effect rounded-xl p-4 md:p-6 card-hover">
            <option value="gpay">📱 GPay</option>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
    </select>

    <h3 class="text-lg font-semibold text-gray-800 flex items-center mb-2 sm:mb-0">
</div>

<i class="fas fa-list-alt text-primary mr-2"></i>

Transaction History <div class="md:flex md:items-end">

    </h3> <button type="submit" <div class="text-sm text-gray-600">
        class="w-full bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-lg font-semibold transition-all text-sm">

        Total Records: {{ $finances->count() }} <i class="fas fa-save mr-1"></i>Set Balance

</div> </button>

</div>
</div>

</div>

@if ($finances->count() > 0)
    </form>

    <div class="overflow-x-auto rounded-lg">
        <p class="text-gray-600 text-xs mt-3">

        <table class="w-full min-w-full"> 💡 Set opening balance (positive for income, negative for expense)

            <thead>
                </p>

                <tr class="bg-gray-50/80">
    </div>

    <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Date</th>

    <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Description</th>
    <!-- Transactions Table -->

    <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Method</th>
    <div class="glass-effect rounded-xl p-4 md:p-6 card-hover">

        <th class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Category</th>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">

            <th class="px-3 py-2 text-right text-xs font-semibold text-green-600 uppercase tracking-wider">Income</th>
            <h3 class="text-lg font-semibold text-gray-800 flex items-center mb-2 sm:mb-0">

                <th class="px-3 py-2 text-right text-xs font-semibold text-red-600 uppercase tracking-wider">Expense
                </th> <i class="fas fa-list-alt text-primary mr-2"></i>

                <th class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Cash Bal
                </th> Transaction History

                <th class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">GPay Bal
                </th>
            </h3>

            <th class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Total Bal
            </th>
            <div class="text-sm text-gray-600">

                <th class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions
                </th> Total Records: {{ $finances->count() }}

                </tr>
            </div>

            </thead>
        </div>

        <tbody class="divide-y divide-gray-200">

            @foreach ($finances as $f)
                @if ($finances->count() > 0)

                    <tr class="finance-row table-row-hover transition-all duration-200 hover:bg-blue-50/50">
                        <div class="overflow-x-auto rounded-lg">

                            <td class="px-3 py-2 text-xs text-gray-700 whitespace-nowrap">
                                {{ $f->date->format('d/m/Y') }}</td>
                            <table class="w-full min-w-full">

                                <td class="px-3 py-2 text-xs font-medium text-gray-900 max-w-[120px] truncate"
                                    title="{{ $f->description }}">{{ $f->description }}</td>
                                <thead>

                                    <td class="px-3 py-2 text-xs whitespace-nowrap">
                                        <tr class="bg-gray-50/80">

                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $f->method == 'cash' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' }}">
                                                <th
                                                    class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">

                                                    {{ $f->method == 'cash' ? '💵 Cash' : '📱 GPay' }} Date</th>

                                            </span>
                                            <th
                                                class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">

                                    </td> Description</th>

                                    <td class="px-3 py-2 text-xs text-gray-700 whitespace-nowrap">
                                    <th
                                        class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">

                                        @if ($f->category) Method
                                    </th>

                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-800">{{ $f->category }}</span>
                                    <th
                                        class="px-3 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    @else
                                        Category</th>

                                    <span class="text-gray-400">-</span>
                                    <th
                                        class="px-3 py-2 text-right text-xs font-semibold text-green-600 uppercase tracking-wider">

                @endif Income</th>

                </td>
                <th class="px-3 py-2 text-right text-xs font-semibold text-red-600 uppercase tracking-wider">

                <td class="px-3 py-2 text-xs text-right font-medium text-green-600 whitespace-nowrap">
                    {{ $f->income > 0 ? '₹' . number_format($f->income, 2) : '-' }}</td> Expense</th>

                <td class="px-3 py-2 text-xs text-right font-medium text-red-600 whitespace-nowrap">
                    {{ $f->expense > 0 ? '₹' . number_format($f->expense, 2) : '-' }}</td>
                <th class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">

                <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">
                    ₹{{ number_format($f->cash_balance, 2) }}</td> Cash Bal</th>

                <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">
                    ₹{{ number_format($f->gpay_balance, 2) }}</td>
                <th class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">

                <td class="px-3 py-2 text-xs text-right font-semibold text-gray-900 whitespace-nowrap">
                    ₹{{ number_format($f->balance, 2) }}</td> GPay Bal</th>

                <td class="px-3 py-2 text-xs text-right whitespace-nowrap">
                <th class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">

                    <div class="flex justify-end space-x-1"> Total Bal
                </th>

                <a href="{{ route('finances.edit', $f->id) }}"
                    class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs hover:bg-blue-200 transition-colors">
                    <th class="px-3 py-2 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">

                        <i class="fas fa-edit mr-1"></i> Edit Actions
                    </th>

                </a> </tr>

                <form method="POST" action="{{ route('finances.destroy', $f->id) }}"
                    onsubmit="return confirm('Are you sure you want to delete this entry?')" class="inline">
                    </thead>

                    @csrf
        <tbody class="divide-y divide-gray-200">

            @method('DELETE') @foreach ($finances as $f)

                <button type="submit"
                    class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded text-xs hover:bg-red-200 transition-colors">
                    <tr class="finance-row table-row-hover transition-all duration-200 hover:bg-blue-50/50">

                        <i class="fas fa-trash mr-1"></i> Delete <td
                            class="px-3 py-2 text-xs text-gray-700 whitespace-nowrap">

                </button> {{ $f->date->format('d/m/Y') }}</td>

                </form>
                <td class="px-3 py-2 text-xs font-medium text-gray-900 max-w-[120px] truncate" </div>
                    title="{{ $f->description }}">

                </td> {{ $f->description }}

                </tr>
                </td>

            @endforeach
            <td class="px-3 py-2 text-xs whitespace-nowrap">

        </tbody> <span <tfoot class="bg-gray-50/80 font-semibold">
            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 

                            <tr>                                        {{ $f->method == 'cash' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' }}">

            <td colspan="4" class="px-3 py-2 text-xs text-gray-700 whitespace-nowrap">Final Totals</td>
            {{ $f->method == 'cash' ? '💵 Cash' : '📱 GPay' }}

            <td class="px-3 py-2 text-xs text-right text-green-600 whitespace-nowrap">
                ₹{{ number_format($totalIncome, 2) }}</td>
        </span>

        <td class="px-3 py-2 text-xs text-right text-red-600 whitespace-nowrap">₹{{ number_format($totalExpense, 2) }}
        </td>
        </td>

        <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">
            ₹{{ number_format($finalCashBalance ?? 0, 2) }}</td>
        <td class="px-3 py-2 text-xs text-gray-700 whitespace-nowrap">

        <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">
            ₹{{ number_format($finalGpayBalance ?? 0, 2) }}</td>
        @if ($f->category)

            <td class="px-3 py-2 text-xs text-right text-gray-900 whitespace-nowrap">
                ₹{{ number_format($finalBalance, 2) }}</td> <span <td></td>
                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-800">

                </tr> {{ $f->category }}

                </tfoot> </span>

            </table>
        @else
    </div> <span class="text-gray-400">-</span>
@else
@endif

<div class="text-center py-8">
    </td>

    <i class="fas fa-receipt text-3xl text-gray-300 mb-3"></i>
    <td class="px-3 py-2 text-xs text-right font-medium text-green-600 whitespace-nowrap">

        <p class="text-gray-500 text-sm">No transactions yet</p>
        {{ $f->income > 0 ? '₹' . number_format($f->income, 2) : '-' }}

        <p class="text-gray-400 text-xs mt-1">Add your first transaction to get started!</p>
    </td>

</div>
<td class="px-3 py-2 text-xs text-right font-medium text-red-600 whitespace-nowrap">

    @endif {{ $f->expense > 0 ? '₹' . number_format($f->expense, 2) : '-' }}

    </div>
</td>

</div>
<td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">

    ₹{{ number_format($f->cash_balance, 2) }}</td>

@push('styles') <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">

        <style>
            ₹{{ number_format($f->gpay_balance, 2) }}</td>@media (max-width: 768px) {
                <td class="px-3 py-2 text-xs text-right font-semibold text-gray-900 whitespace-nowrap">.overflow-x-auto {
                    ₹{{ number_format($f->balance, 2) }}</td>-webkit-overflow-scrolling: touch;
                    <td class="px-3 py-2 text-xs text-right whitespace-nowrap">
                }

                <div class="flex justify-end space-x-1">table {
                    <a href="{{ route('finances.edit', $f->id) }}" font-size: 0.75rem;
                    class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs hover:bg-blue-200 transition-colors">
                }

                <i class="fas fa-edit mr-1"></i>Edit .finance-row td {
                    </a>padding: 0.5rem 0.25rem;
                    <form method="POST" action="{{ route('finances.destroy', $f->id) }}"
                }

                onsubmit="return confirm('Are you sure you want to delete this entry?')"
            }

            class="inline">@csrf .overflow-x-auto {
                @method('DELETE')

                overflow-x: auto;
                <button type="submit" width: 100%;
                class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded text-xs hover:bg-red-200 transition-colors">
            }

            <i class="fas fa-trash mr-1"></i>Delete </button>@media (max-width: 640px) {
                </form>.stats-card {
                    </div>padding: 0.75rem;
                    </td>
                }

                </tr>.stats-card p.text-xl {@endforeach

                font-size: 1.125rem;
                </tbody>
            }

            <tfoot class="bg-gray-50/80 font-semibold">.glass-effect {
                <tr>padding: 1rem;
                <td colspan="4" class="px-3 py-2 text-xs text-gray-700 whitespace-nowrap">Final Totals
            }

            </td>
            }

            <td class="px-3 py-2 text-xs text-right text-green-600 whitespace-nowrap">₹{{ number_format($totalIncome, 2) }}</td>.errors {
                <td class="px-3 py-2 text-xs text-right text-red-600 whitespace-nowrap">background: #fff5f5;
                ₹{{ number_format($totalExpense, 2) }}</td>border: 1px solid rgba(239, 68, 68, 0.12);
                <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">color: #ef4444;
                ₹{{ number_format($finalCashBalance ?? 0, 2) }}</td>padding: 10px;
                <td class="px-3 py-2 text-xs text-right text-gray-700 whitespace-nowrap">border-radius: 6px;
                ₹{{ number_format($finalGpayBalance ?? 0, 2) }}</td>margin-bottom: 12px;
                <td class="px-3 py-2 text-xs text-right text-gray-900 whitespace-nowrap">
            }

            ₹{{ number_format($finalBalance, 2) }}</td><td></td>.errors li {
                </tr>list-style: disc;
                </tfoot>margin-left: 20px;
                </table>
            }

            </div>
        </style>
    @else
    @endpush <div class="text-center py-8">

        <i class="fas fa-receipt text-3xl text-gray-300 mb-3"></i>

        @push('scripts') <p class="text-gray-500 text-sm">No transactions yet</p>

            <script>
                < p class = "text-gray-400 text-xs mt-1" > Add your first transaction to get started! < /p>

                document.addEventListener('DOMContentLoaded', function() {
                            < /div>

                            // Auto-format currency inputs        @endif

                            const incomeInput = document.querySelector('input[name="income"]'); < /div>

                            const expenseInput = document.querySelector('input[name="expense"]'); < /div>

                            const amountInput = document.querySelector('input[name="amount"]');

                            @push('styles')

                                function formatCurrencyInput(input) {
                                    < style >

                                        input.addEventListener('blur', function() {
                                                @media(max - width: 768 px) {

                                                    if (this.value) {
                                                        .overflow - x - auto {

                                                            this.value = parseFloat(this.value).toFixed(2); - webkit -
                                                                overflow - scrolling: touch;

                                                        }
                                                    }

                                                });

                                        }
                                    table {

                                        font - size: 0.75 rem;

                                        if (incomeInput) formatCurrencyInput(incomeInput);
                                    }

                                    if (expenseInput) formatCurrencyInput(expenseInput);

                                    if (amountInput) formatCurrencyInput(amountInput);.finance - row td {

                                        padding: 0.5 rem 0.25 rem;

                                        // Ensure only one of income/expense is filled                }

                                        function validateAmounts() {}

                                        if (incomeInput && expenseInput) {

                                            if (incomeInput.value && expenseInput.value) {
                                                /* Ensure table is properly scrollable on mobile */

                                                expenseInput.value = '';.overflow - x - auto {

                                                }
                                                overflow - x: auto;

                                            }
                                            width: 100 % ;

                                        }
                                    }



                                    if (incomeInput) incomeInput.addEventListener('input',
                                    validateAmounts); /* Fix for small screens */

                                    if (expenseInput) expenseInput.addEventListener('input', validateAmounts);
                                    @media(max - width: 640 px) {

                                    });.stats - card {
            </script> padding: 0.75rem;

            }

            <script>
                // Handle form submission validation and sync duplicate form controls                .stats-card p.text-xl {

                document.addEventListener('DOMContentLoaded', function() {
                        font - size: 1.125 rem;

                        const form = document.getElementById('add-transaction-form');
                    }

                    if (!form) return;

                    .glass - effect {

                        const income = form.querySelector('input[name="income"]');
                        padding: 1 rem;

                        const expense = form.querySelector('input[name="expense"]');
                    }

                    const method = form.querySelector('select[name="method"]');
                }

                const errorDiv = document.getElementById('form-error');

                .errors {

                    // Robustly sync duplicate inputs (mobile + desktop) to disable hidden ones                background: #fff5f5;

                    function isVisible(el) {
                        border: 1 px solid rgba(239, 68, 68, 0.12);

                        if (!el || el.type === 'hidden') return false;color: var (--danger);

                        const style = window.getComputedStyle(el);padding: 10 px;

                        if (style.display === 'none' || style.visibility === 'hidden' || style.opacity === '0')
                        return false;border - radius: 6 px;

                        const rects = el.getClientRects();margin - bottom: 12 px

                        return rects.length > 0 && rects[0].width > 0 && rects[0].height > 0;
                    }

                } < /style>
                @endpush

                function syncFormControls() {

                    const named = {};
                    @push('scripts')

                        form.querySelectorAll('input[name],select[name],textarea[name]').forEach(el => {
                                    < script >

                                        if (el.type === 'hidden' || el.matches('button,input[type="submit"]')) return;
                                    document.addEventListener('DOMContentLoaded', function() {

                                        const name = el.getAttribute('name'); // Auto-format currency inputs

                                        if (!name) return;
                                        const incomeInput = document.querySelector('input[name="income"]');

                                        named[name] = named[name] || [];
                                        const expenseInput = document.querySelector('input[name="expense"]');

                                        named[name].push(el);
                                        const amountInput = document.querySelector('input[name="amount"]');

                                    });

                                    function formatCurrencyInput(input) {

                                        Object.keys(named).forEach(name => {
                                                input.addEventListener('blur', function() {

                                                        const group = named[name];
                                                        if (this.value) {

                                                            const visible = group.find(isVisible) || group[0];
                                                            this.value = parseFloat(this.value).toFixed(2);

                                                            group.forEach(el => {}

                                                                if (el === visible) {});

                                                            el.removeAttribute('disabled');
                                                        }

                                                    } else {

                                                        el.setAttribute('disabled', 'disabled');
                                                        if (incomeInput) formatCurrencyInput(incomeInput);

                                                    }
                                                    if (expenseInput) formatCurrencyInput(expenseInput);

                                                });
                                            if (amountInput) formatCurrencyInput(amountInput);

                                        });

                                } // Ensure only one of income/expense is filled

                                function validateAmounts() {

                                    // Initial sync                    if (incomeInput && expenseInput) {

                                    syncFormControls();
                                    if (incomeInput.value && expenseInput.value) {

                                        expenseInput.value = '';

                                        // Re-sync on resize and orientation change                        }

                                        let resizeTimer;
                                    }

                                    window.addEventListener('resize', function() {}

                                        clearTimeout(resizeTimer);

                                        resizeTimer = setTimeout(syncFormControls, 120);
                                        if (incomeInput) incomeInput.addEventListener('input', validateAmounts);

                                    });
                                if (expenseInput) expenseInput.addEventListener('input', validateAmounts);

                                window.addEventListener('orientationchange', function() {});

                                setTimeout(syncFormControls, 150);
            </script>

        }); @endpush

    @endsection

    // Validate on submit

    form.addEventListener('submit', function(e) {@push('scripts')

        if (errorDiv) {
        <script>
            errorDiv.style.display = 'none';
            document.addEventListener('DOMContentLoaded', function() {

                errorDiv.innerHTML = '';
                const form = document.getElementById('add-transaction-form');

            }
            if (!form) return;

            const income = form.querySelector('input[name="income"]');

            if (method && !method.value) {
                const expense = form.querySelector('input[name="expense"]');

                e.preventDefault();
                const method = form.querySelector('select[name="method"]');

                if (errorDiv) {
                    const errorDiv = document.getElementById('form-error');

                    errorDiv.style.display = 'block';

                    errorDiv.innerHTML = '<ul><li>Please select a payment method.</li></ul>';
                    form.addEventListener('submit', function(e) {

                        } // Clear previous error

                        return false;
                        if (errorDiv) {

                        }
                        errorDiv.style.display = 'none';

                        errorDiv.innerHTML = '';

                        const inc = parseFloat(income?.value || 0);
                    }

                    const exp = parseFloat(expense?.value || 0);

                    if ((!inc || inc <= 0) && (!exp || exp <= 0)) { // Ensure method selected

                        e.preventDefault();
                        if (method && !method.value) {

                            if (errorDiv) {
                                e.preventDefault();

                                errorDiv.style.display = 'block';
                                if (errorDiv) {

                                    errorDiv.innerHTML = '<ul><li>Enter an amount for Income or Expense.</li></ul>';
                                    errorDiv.style.display = 'block';

                                }
                                errorDiv.innerText = 'Please select a payment method.';

                                return false;
                            }

                        }
                        return false;

                    });
            }

            });
        </script> const inc = parseFloat(income?.value || 0);

    @endpush const exp = parseFloat(expense?.value || 0);

@endsection if ((!inc || inc <= 0) && (!exp || exp <=0)) { e.preventDefault(); if (errorDiv) {
    errorDiv.style.display = 'block'; errorDiv.innerText = 'Enter an amount for Income or Expense.'; } return
    false; } }); }); </script>
    <script>
        // Prevent "An invalid form control is not focusable" caused by duplicate
        // inputs used for responsive layouts (mobile + desktop variants).
        // We disable controls that aren't visible so browser validation ignores them.
        (function() {
            function isVisible(el) {
                if (!el) return false;
                // hidden inputs (like _token) should not be disabled
                if (el.type === 'hidden') return true;
                const rects = el.getClientRects();
                if (rects.length === 0) return false;
                const style = window.getComputedStyle(el);
                return style.visibility !== 'hidden' && style.display !== 'none' && rects[0].width > 0 && rects[0]
                    .height > 0;
            }

            function syncFormControls(form) {
                if (!form) return;
                const controls = form.querySelectorAll('input, select, textarea');
                controls.forEach(control => {
                    // never disable hidden fields (csrf token etc.)
                    if (control.type === 'hidden') {
                        control.removeAttribute('disabled');
                        return;
                    }
                    // don't touch submit buttons here
                    if (control.matches('button,input[type="submit"]')) return;

                    if (isVisible(control)) {
                        control.removeAttribute('disabled');
                    } else {
                        control.setAttribute('disabled', 'disabled');
                    }
                });
            }

            const addForm = document.getElementById('add-transaction-form');
            if (addForm) {
                // initial sync
                syncFormControls(addForm);
                // re-sync on resize (debounced)
                let t = null;
                window.addEventListener('resize', function() {
                    clearTimeout(t);
                    t = setTimeout(function() {
                        syncFormControls(addForm);
                    }, 120);
                });
            }
        })();
    </script>
@endpush
