<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model {

	protected $table = 'logs';

	protected $fillable = [
		'user_id',
		'loggable_id',
		'loggable_type',
		'data'
	];

	protected $casts = [
		'user_id' => 'integer',
		'loggable_id' => 'integer',
		'loggable_type' => 'string',
		'data' => 'string'
	];

	public function user() {
		return $this->belongsTo('\App\User');
	}

	public function loggable() {
		return $this->morphTo();
	}

}
