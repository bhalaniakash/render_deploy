<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'description',
        'method',
        'category',
        'income',
        'expense',
        'balance',
        'cash_balance',
        'gpay_balance',
    ];

    protected $casts = [
        'date' => 'date',
        'income' => 'decimal:2',
        'expense' => 'decimal:2',
        'balance' => 'decimal:2',
        'cash_balance' => 'decimal:2',
        'gpay_balance' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
