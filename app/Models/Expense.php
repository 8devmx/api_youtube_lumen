<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'date', 'amount', 'category_id', 'user_id', 'repeat', 'note'
    ];
}
