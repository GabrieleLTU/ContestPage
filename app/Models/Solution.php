<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = [
        'answer'
    ];
    protected $hidden = [
        'user_id', 'problem_id', 'correct', 'created_at', 'updated_at'
    ];
}
