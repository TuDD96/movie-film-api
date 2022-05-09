<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookLeagueMapping extends Model
{
    protected $fillable = [
    	'book_id',
        'league_id',
        'total_score',
    ];
}
