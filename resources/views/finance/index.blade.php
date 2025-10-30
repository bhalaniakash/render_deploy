@extends('layouts.app')

@section('title', 'Finances')

@section('content')
    <h2>Finance ledger</h2>

    <div style="display:flex;gap:12px;align-items:flex-start;margin-bottom:18px;flex-wrap:wrap">
        <form method="POST" action="{{ route('finances.store') }}" style="flex:1;min-width:420px" data-validate="">
            @csrf
            <div style="display:grid;grid-template-columns:140px 1fr 110px 110px 110px;gap:8px;align-items:end">
                <div>
                    <label>Date</label>
                    <input type="date" name="date" max="{{ now()->toDateString() }}"
                        value="{{ old('date', now()->toDateString()) }}" required>
                </div>
                <div>
                    <label>Description</label>
                    <input type="text" name="description" value="{{ old('description') }}" placeholder="e.g. Lunch"
                        required>
                </div>
                <div>
                    <label>Method</label>
                    <select name="method" required
                        style="width:100%;padding:10px;border-radius:8px;border:1px solid #e6e9ef">
                        <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="gpay" {{ old('method') == 'gpay' ? 'selected' : '' }}>GPay</option>
                    </select>
                </div>
                <div>
                    <label>Category</label>
                    <input type="text" name="category" value="{{ old('category') }}" placeholder="e.g. Food" />
                </div>
                <div>
                    <label>Income</label>
                    <input type="text" name="income" value="{{ old('income') }}" placeholder="0.00">
                </div>
                <div>
                    <label>Expense</label>
                    <input type="text" name="expense" value="{{ old('expense') }}" placeholder="0.00">
                </div>
                <div>
                    <button type="submit">Add</button>
                </div>
            </div>
        </form>

        <div style="width:260px;min-width:200px">
            <div class="card" style="padding:12px">
                <div style="font-weight:700;margin-bottom:8px">Opening balance</div>
                <form method="POST" action="{{ route('finances.opening') }}">
                    @csrf
                    <div style="display:flex;gap:8px">
                        <input type="number" step="0.01" name="amount" placeholder="0.00"
                            style="flex:1;padding:8px;border-radius:8px;border:1px solid #e6e9ef">
                        <select name="method" required style="padding:8px;border-radius:8px;border:1px solid #e6e9ef">
                            <option value="cash">Cash</option>
                            <option value="gpay">GPay</option>
                        </select>
                        <button type="submit">Set</button>
                    </div>
                    <div class="small" style="margin-top:8px;color:#6b7280">Set opening balance (positive for income,
                        negative for expense)</div>
                </form>
            </div>
        </div>
    </div>

    <div style="overflow:auto">
        <table style="width:100%;border-collapse:collapse">
            <thead>
                <tr style="text-align:left;border-bottom:1px solid #e6e9ef">
                    <th style="padding:8px">Date</th>
                    <th style="padding:8px">Description</th>
                    <th style="padding:8px">Method</th>
                    <th style="padding:8px">Category</th>
                    <th style="padding:8px"></th>Income</th>
                    <th style="padding:8px">Expense</th>
                    <th style="padding:8px">Cash Bal</th>
                    <th style="padding:8px">GPay Bal</th>
                    <th style="padding:8px">Total Bal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($finances as $f)
                    <tr class="finance-row" style="transition:background .2s">
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">{{ $f->date->format('d/m/Y') }}</td>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">{{ $f->description }}</td>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9;text-transform:capitalize">
                            {{ $f->method }}</td>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">{{ $f->category ?? '-' }}</td>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">
                            {{ $f->income > 0 ? number_format($f->income, 2) : '-' }}</td>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">
                            {{ $f->expense > 0 ? number_format($f->expense, 2) : '-' }}</td>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">
                            {{ number_format($f->cash_balance, 2) }}</td>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">
                            {{ number_format($f->gpay_balance, 2) }}</td>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">{{ number_format($f->balance, 2) }}
                            <div style="margin-top:6px">
                                <a href="{{ route('finances.edit', $f->id) }}"
                                    style="margin-right:8px;color:#2563eb">Edit</a>
                                <form method="POST" action="{{ route('finances.destroy', $f->id) }}"
                                    style="display:inline" onsubmit="return confirm('Delete this entry?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background:transparent;border:none;color:#ef4444;cursor:pointer">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="padding:12px">No entries yet</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr style="font-weight:700;border-top:1px solid #e6e9ef">
                    <td colspan="4" style="padding:10px">Final</td>
                    <td style="padding:10px">{{ number_format($totalIncome, 2) }}</td>
                    <td style="padding:10px">{{ number_format($totalExpense, 2) }}</td>
                    <td style="padding:10px">{{ number_format($finalCashBalance ?? 0, 2) }}</td>
                    <td style="padding:10px">{{ number_format($finalGpayBalance ?? 0, 2) }}</td>
                    <td style="padding:10px">{{ number_format($finalBalance, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection
