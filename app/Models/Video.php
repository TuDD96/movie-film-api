<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $primaryKey = 'video_id';

    protected $fillable = [
    	'video_url',
        'thumbnail_url',
        'title',
    ];
}
