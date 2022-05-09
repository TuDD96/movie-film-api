<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftPurchaseHistory extends Model
{
    protected $fillable = [
        'user_gift_id',
        'user_point_id',
        'points_spent',
        'purchased_at'
    ];
}
