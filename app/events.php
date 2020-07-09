<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'location'
    ];
}
