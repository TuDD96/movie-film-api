<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $primaryKey = 'block_id';

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'created_at',
        'updated_at',
    ];
}
