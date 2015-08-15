<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

	protected $table = 'locations';

	protected $fillable = [
		'name',
		'type',
		'active',
		'parent_id'
	];

	public function children() {
		return $this->hasMany('App\Location', 'parent_id');
	}

	public static function countries() {
		return self::where('type', '=', 0)->where('active', '=', 1)->orderBy('name')->get();
	}

	public static function states($parent_id = null) {
		if ($parent_id) {
			return self::where('type', '=', 1)->where('active', '=', 1)->where('parent_id', '=', $parent_id)->orderBy('name')->get();
		} else {
			return self::where('type', '=', 1)->where('active', '=', 1)->orderBy('name')->get();
		}
	}

	public static function cities($parent_id = null) {
		if ($parent_id) {
			return self::where('type', '=', 2)->where('active', '=', 1)->where('parent_id', '=', $parent_id)->orderBy('name')->get();
		} else {
			return self::where('type', '=', 2)->where('active', '=', 1)->orderBy('name')->get();
		}
	}

}
