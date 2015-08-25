<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model {

	use SoftDeletes;

	protected $table = 'items';

	protected $fillable = [
		'product_id',
		'quantity',
		'cart_id'
	];

	protected $dates = [
		'deleted_at'
	];

	protected $casts = [
		'product_id' => 'integer',
		'quantity' => 'integer',
		'cart_id' => 'integer'
	];

	//item attributes

	public function price() {
	}

}
