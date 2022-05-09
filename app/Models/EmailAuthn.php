<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailAuthn extends Model
{
    protected $fillable = [
        'user_type',
        'email',
        'token'
    ];
}
