<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefreshToken extends Model
{
    protected $primaryKey = 'refresh_token_id';

    protected $fillable = [
    	'user_id',
        'encrypted_refresh_token',
        'expires_in',
        'is_blacklisted',
    ];
}
