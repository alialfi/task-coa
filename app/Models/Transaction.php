<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'chart_of_account_id',
        'date',
        'description',
        'debit',
        'credit',
    ];

    public function chart_of_account()
    {
        return $this->belongsTo(ChartOfAccount::class);
    }
}