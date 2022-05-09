<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedLink extends Model
{
    protected $fillable = [
    	'title',
        'link_url',
        'file_name',
        'dir_path',
        'image_url',
        'display_order',
    ];
}
