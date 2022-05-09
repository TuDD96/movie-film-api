<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointsPackagePurchaseHistory extends Model
{
    protected $fillable = [
        'user_point_id',
        'points_package_id',
        'payment_amount',
        'purchased_at',
        'apple_trans_id',
        'google_trans_id',
        'apple_receipt',
        'google_receipt'
    ];
}
