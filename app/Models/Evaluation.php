<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
    	'user_id',
        'book_id',
        'league_id',
        'score',
    ];
}
