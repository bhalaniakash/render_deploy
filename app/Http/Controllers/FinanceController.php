<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $finances = Finance::where('user_id', $user->id)->orderBy('date', 'asc')->orderBy('id','asc')->get();

        // Calculate totals and running balance (if balance stored, prefer stored value)
        $totalIncome = $finances->sum('income');
        $totalExpense = $finances->sum('expense');
        $finalBalance = $finances->last()?->balance ?? ($totalIncome - $totalExpense);

        return view('finance.index', compact('finances', 'totalIncome', 'totalExpense', 'finalBalance'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'date' => 'required|date',
            'description' => 'required|string|max:255',
            'income' => 'nullable|numeric|min:0',
            'expense' => 'nullable|numeric|min:0',
        ]);

        $income = $data['income'] ?? 0;
        $expense = $data['expense'] ?? 0;

        if ($income == 0 && $expense == 0) {
            return back()->withErrors(['income' => 'Provide income or expense amount'])->withInput();
        }

        // previous balance
        $last = Finance::where('user_id', $user->id)->orderBy('date', 'desc')->orderBy('id','desc')->first();
        $prevBalance = $last?->balance ?? 0;

        $newBalance = $prevBalance + $income - $expense;

        Finance::create([
            'user_id' => $user->id,
            'date' => $data['date'],
            'description' => $data['description'],
            'income' => $income,
            'expense' => $expense,
            'balance' => $newBalance,
        ]);

        return redirect()->route('finances.index');
    }
}
