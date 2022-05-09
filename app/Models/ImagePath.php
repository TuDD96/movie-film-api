<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagePath extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'file_name',
        'dir_path',
        'image_url',
        'display_order'
    ];
}
