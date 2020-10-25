<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $guarded = [];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'floor_id');
    }

    public function attachment()
	{
		return $this->hasOne(Upload::class, 'id', 'upload_id');
	}
}