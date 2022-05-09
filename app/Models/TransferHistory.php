<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferHistory extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'withdrawal_amount',
        'transfer_fee',
        'transfer_amount',
        'transferred_at',
    ];
}
