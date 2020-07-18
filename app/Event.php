<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'location_id'
    ];
    // one to one relation using eloquent
    // this means location_id column in event model belongs to id of location class
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
