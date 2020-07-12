<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	protected $fillable = [
		'name', 'type', 'parent_id'
	];
	// Accessor function from: https://laravel.com/docs/7.x/eloquent-mutators
	public function getTypeAttribute($value)
	{
		switch ($value) {
			case "0":
				return "Campus";
				break;
			case "1":
				return "Building";
				break;
			case "2":
				return "Room";
				break;
		}
	}

    public function children()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }
    // using eloquent self-join to get the id and the parent_id matches
    // this method will be called to retrieve the name of the parent
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
}
