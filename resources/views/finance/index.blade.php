@extends('layouts.app')

@section('title', 'Finances')

@section('content')
    <h2>Finance ledger</h2>

    <form method="POST" action="{{ route('finances.store') }}" style="margin-bottom:18px" data-validate="">
        @csrf
        <div style="display:grid;grid-template-columns:140px 1fr 110px 110px 110px;gap:8px;align-items:end">
            <div>
                <label>Date</label>
                <input type="date" name="date" value="{{ old('date', now()->toDateString()) }}" required>
            </div>
            <div>
                <label>Description</label>
                <input type="text" name="description" value="{{ old('description') }}" placeholder="e.g. Lunch" required>
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

    <div style="overflow:auto">
        <table style="width:100%;border-collapse:collapse">
            <thead>
                <tr style="text-align:left;border-bottom:1px solid #e6e9ef">
                    <th style="padding:8px">Date</th>
                    <th style="padding:8px">Description</th>
                    <th style="padding:8px">Income</th>
                    <th style="padding:8px">Expense</th>
                    <th style="padding:8px">Balance</th>
                </tr>
            </thead>
            <tbody>
                @forelse($finances as $f)
                    <tr>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">{{ $f->date->format('d/m/Y') }}</td>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">{{ $f->description }}</td>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">
                            {{ $f->income > 0 ? number_format($f->income, 2) : '-' }}</td>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">
                            {{ $f->expense > 0 ? number_format($f->expense, 2) : '-' }}</td>
                        <td style="padding:10px 8px;border-bottom:1px solid #f1f5f9">{{ number_format($f->balance, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:12px">No entries yet</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr style="font-weight:700;border-top:1px solid #e6e9ef">
                    <td colspan="2" style="padding:10px">Final</td>
                    <td style="padding:10px">{{ number_format($totalIncome, 2) }}</td>
                    <td style="padding:10px">{{ number_format($totalExpense, 2) }}</td>
                    <td style="padding:10px">{{ number_format($finalBalance, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection
