<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model {

	use SoftDeletes;

	protected $table = 'cards';

	protected $fillable = [
		'type',
		'last_4',
		'ex_month',
		'ex_year',
		'stripe_token',
		'user_id'
	];

	protected $dates = [
		'deleted_at'
	];

	protected $casts = [
		'user_id' => 'integer'
	];

}
