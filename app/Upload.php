<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $guarded = [];

    public function getUrlAttribute()
    {
        return asset("storage/" . $this->uri);
    }
}
