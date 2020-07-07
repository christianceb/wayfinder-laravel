<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
	protected $fillable = [
		'locationsName', 'locationsType'
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
}
