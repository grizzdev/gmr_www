<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neworder extends Model {

	protected $table = 'neworders';

	protected $fillable = [
		'user_id',
		'cart_id',
		'payment_method_id',
		'payment_token',
		'payment_status_id',
		'status_id',
		'card_id',
		'billing_address_id',
		'shipping_address_id',
		'meta'
	];

	protected $casts = [
		'user_id' => 'integer',
		'cart_id' => 'integer',
		'payment_method_id' => 'integer',
		'payment_status_id' => 'integer',
		'status_id' => 'integer',
		'card_id' => 'integer',
		'billing_address_id' => 'integer',
		'shipping_address_id' => 'integer'
	];

	public function user() {
	}

	public function payment_method() {
	}

	public function payment_status() {
	}

	public function status() {
	}

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

	public function billing_address() {
	}

	public function shipping_address() {
	}

	public function card() {
	}

	public function email($tos = []) {
	}

	public function hash() {
	}

	public function log($user_id, $data) {
	}

	public function taxes() {
	}

}
