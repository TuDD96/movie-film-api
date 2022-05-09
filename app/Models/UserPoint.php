<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    protected $primaryKey = 'user_point_id';

    protected $fillable = [
        'user_id',
        'type',
        'deposit_reason',
        'deposit_points',
        'withdrawal_points',
        'withdrawal_reason',
        'transacted_at',
        'points_balance'
    ];
}
