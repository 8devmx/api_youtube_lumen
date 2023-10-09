<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['id', 'date', 'amount', 'category_id', 'user_id', 'repeat', 'note', 'category_id', 'user_id'];
}
