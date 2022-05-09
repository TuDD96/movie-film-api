<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $primaryKey = 'book_id';

    protected $fillable = [
    	'user_id',
        'thumbnail_url',
        'ebook_url',
        'title',
        'is_hidden',
    ];

    public function leagues()
    {
        return $this->belongsToMany(League::class, 'book_league_mappings', 'league_id', 'book_id');
    }
}
