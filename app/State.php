<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class State extends Model {

	protected $fillable = [
		'id',
		'name',
		'enabled',
		'country_id'
	];

	public function country() {
		return $this->hasOne('App\Country');
	}

	public function cities() {
		return $this->hasMany('App\City');
	}
}
