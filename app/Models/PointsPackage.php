<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointsPackage extends Model
{
    protected $primaryKey = 'points_package_id';

    protected $fillable = [
        'apple_product_id',
        'google_product_id',
        'name',
        'price',
        'points',
        'display_order'
    ];
}
