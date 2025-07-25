<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    protected $table = 'chart_of_accounts';

    protected $fillable = [
        'category_id',
        'code',
        'name',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
