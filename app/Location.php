<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	protected $guarded = ['parent_id'];
	private $types = ["Campus", "Building", "Room"];

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

	public function getTypeNameAttribute()
	{
		return $this->types[$this->type] ?? null;
	}

	public function children()
	{
		return $this->hasMany(self::class, 'parent_id');
	}

	public function parent()
	{
		return $this->belongsTo(self::class, 'parent_id');
	}

	public function attachment()
	{
			return $this->hasOne(Upload::class, 'id', 'upload_id');
	}
}
