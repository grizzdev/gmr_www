<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventJob extends Model {

	protected $fillable = [
		'title',
		'description',
		'event_id'
	];

	protected $casts = [
		'title' => 'string',
		'description' => 'string',
		'event_id' => 'integer'
	];

	protected $rules = [
		'title' => 'string,max:64',
		'description' => 'string,NULL',
		'event_id' => 'integer,exists:events'
	];

	protected $dates = [
		'deleted_at'
	];

	public function event() {
		return $this->belongsTo('\App\Event');
	}

	public function shifts() {
		return $this->hasMany('\App\EventShift');
	}

}
