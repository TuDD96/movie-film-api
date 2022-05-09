<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGift extends Model
{
    protected $primaryKey = 'user_gift_id';

    protected $fillable = [
        'user_id',
        'gift_id',
        'status',
        'used_at'
    ];
}
