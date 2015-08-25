<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

	protected $table = 'carts';

	protected $fillable = [
		'user_id',
		'coupon_id'
	];

	protected $casts = [
		'user_id' => 'integer',
		'coupon_id' => 'integer'
	];

	public function subtotal() {
	}

	public function shipping() {
	}

	public function discount() {
	}

	public function total() {
	}

	public function count() {
	}

	public function contribution($hero_id = null) {
	}

	public function add($product_id, $attrs = [], $quantity = 1) {
	}

	public function remove($item_id) {
	}

	public function update($item_id, $quantity) {
	}

}
