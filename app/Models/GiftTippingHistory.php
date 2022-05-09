<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftTippingHistory extends Model
{
    protected $fillable = [
        'user_gift_id',
        'to_user_id',
        'points_equivalent',
        'tipped_at'
    ];
}
