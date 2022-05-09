<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SoftDeletes\CustomSoftDeletes;

class Event extends Model
{
    use CustomSoftDeletes;

    protected $primaryKey = 'event_id';

    protected $fillable = [
    	'title',
        'body',
        'is_archived',
    ];

    protected $hidden = ['is_archived'];
}
