<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $primaryKey = 'applicant_id';

    protected $fillable = [
    	'user_id',
        'league_id',
    ];
}
