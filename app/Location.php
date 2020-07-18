<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	protected $fillable = [
		'name', 'type', 'parent_id'
	];
	// static function that can be used on blade files
	// references: https://stackoverflow.com/questions/29007639/laravel-5-call-a-model-function-in-a-blade-view
	public static function getType($typeId)
	{
		switch ($typeId) {
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
