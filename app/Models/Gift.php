<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $primaryKey = 'gift_id';

    protected $fillable = [
    	'image_url',
        'name',
        'points_spent',
        'display_order',
    ];

    public function userGifts()
    {
        return $this->hasMany(UserGift::class, 'gift_id');
    }
    
}
