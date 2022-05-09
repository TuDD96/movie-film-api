<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'reason',
        'comment',
        'created_at',
        'updated_at',
    ];
}
