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

        // Calculate totals and per-method totals
        $totalIncome = $finances->sum('income');
        $totalExpense = $finances->sum('expense');

        $totalCashIncome = $finances->where('method','cash')->sum('income');
        $totalGpayIncome = $finances->where('method','gpay')->sum('income');
        $totalCashExpense = $finances->where('method','cash')->sum('expense');
        $totalGpayExpense = $finances->where('method','gpay')->sum('expense');

        $finalCashBalance = $finances->last()?->cash_balance ?? ($totalCashIncome - $totalCashExpense);
        $finalGpayBalance = $finances->last()?->gpay_balance ?? ($totalGpayIncome - $totalGpayExpense);
        $finalBalance = $finalCashBalance + $finalGpayBalance;

        return view('finance.index', compact('finances', 'totalIncome', 'totalExpense', 'finalBalance', 'totalCashIncome', 'totalGpayIncome', 'totalCashExpense', 'totalGpayExpense', 'finalCashBalance', 'finalGpayBalance'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            // date must not be in the future
            'date' => 'required|date|before_or_equal:today',
            'description' => 'required|string|max:255',
            'method' => 'required|in:cash,gpay',
            'category' => 'nullable|string|max:100',
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
            'method' => $data['method'],
            'category' => $data['category'] ?? null,
            'income' => $income,
            'expense' => $expense,
            'balance' => $newBalance,
            'cash_balance' => 0,
            'gpay_balance' => 0,
        ]);

        // Recompute balances to ensure all rows are consistent
        $this->recomputeBalances($user->id);

        return redirect()->route('finances.index')->with('success','Entry added');
    }

    /** Show edit form */
    public function edit($id)
    {
        $user = Auth::user();
        $entry = Finance::where('user_id', $user->id)->where('id', $id)->firstOrFail();
        return view('finance.edit', compact('entry'));
    }

    /** Update an entry and recompute balances */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $entry = Finance::where('user_id', $user->id)->where('id', $id)->firstOrFail();

        $data = $request->validate([
            'date' => 'required|date|before_or_equal:today',
            'description' => 'required|string|max:255',
            'method' => 'required|in:cash,gpay',
            'category' => 'nullable|string|max:100',
            'income' => 'nullable|numeric|min:0',
            'expense' => 'nullable|numeric|min:0',
        ]);

        $income = $data['income'] ?? 0;
        $expense = $data['expense'] ?? 0;

        if ($income == 0 && $expense == 0) {
            return back()->withErrors(['income' => 'Provide income or expense amount'])->withInput();
        }

        $entry->update([
            'date' => $data['date'],
            'description' => $data['description'],
            'method' => $data['method'],
            'category' => $data['category'] ?? null,
            'income' => $income,
            'expense' => $expense,
        ]);

        $this->recomputeBalances($user->id);

        return redirect()->route('finances.index')->with('success','Entry updated');
    }

    /** Delete an entry and recompute */
    public function destroy($id)
    {
        $user = Auth::user();
        $entry = Finance::where('user_id', $user->id)->where('id', $id)->firstOrFail();
        $entry->delete();
        $this->recomputeBalances($user->id);
        return redirect()->route('finances.index')->with('success','Entry deleted');
    }

    /** Store an opening balance entry */
    public function storeOpening(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'amount' => 'required|numeric',
            'method' => 'required|in:cash,gpay',
            'date' => 'nullable|date|before_or_equal:today',
        ]);

        $amount = $data['amount'];
        $date = $data['date'] ?? now()->toDateString();

        // create opening balance as income with description
        Finance::create([
            'user_id' => $user->id,
            'date' => $date,
            'description' => 'Opening balance',
            'method' => $data['method'],
            'category' => 'opening',
            'income' => $amount > 0 ? $amount : 0,
            'expense' => $amount < 0 ? abs($amount) : 0,
            'balance' => $amount,
            'cash_balance' => 0,
            'gpay_balance' => 0,
        ]);

        $this->recomputeBalances($user->id);

        return redirect()->route('finances.index')->with('success','Opening balance set');
    }

    /** Recompute balances sequentially for a user */
    protected function recomputeBalances($userId)
    {
        $rows = Finance::where('user_id', $userId)->orderBy('date', 'asc')->orderBy('id','asc')->get();
        $cash = 0.0;
        $gpay = 0.0;
        foreach ($rows as $r) {
            // apply to the appropriate method balance
            if ($r->method === 'cash') {
                $cash = $cash + (float)$r->income - (float)$r->expense;
            } else {
                $gpay = $gpay + (float)$r->income - (float)$r->expense;
            }

            $r->cash_balance = $cash;
            $r->gpay_balance = $gpay;
            $r->balance = $cash + $gpay;
            $r->save();
        }
    }
}
