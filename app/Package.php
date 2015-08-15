<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model {

	use SoftDeletes;

	protected $table = 'packages';

	protected $fillable = [
		'name',
		'description',
		'cost'
	];

	protected $dates = [
		'deleted_at'
	];

}
