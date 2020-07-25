<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $guarded = ['file'];
    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return $this->remote_url ?? asset("storage/" . $this->uri);
    }

    public function getSizeInKbAttribute() {
        return round($this->size / 1024, 2);
    }
}