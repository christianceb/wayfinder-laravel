<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $guarded = ['file'];
    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return asset("storage/" . $this->uri);
    }
}