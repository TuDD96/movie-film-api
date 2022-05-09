<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SoftDeletes\CustomSoftDeletes;

class League extends Model
{
    use CustomSoftDeletes;

    protected $primaryKey = 'league_id';

    protected $fillable = [
        'event_id',
        'type',
        'parent_league_id',
        'name',
        'entry_start_datetime',
        'entry_end_datetime',
        'entry_fee',
        'fixed_num',
        'num_of_applicants',
        'start_datetime',
        'end_datetime',
        'is_archived',
    ];

    protected $hidden = ['is_archived'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_league_mappings', 'book_id', 'league_id');
    }
}
