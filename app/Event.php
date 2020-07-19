<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'location_id',
        'upload_id'
    ];

    public function location()
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function attachment()
    {
        return $this->hasOne(Upload::class, 'id', 'upload_id');
    }
}
