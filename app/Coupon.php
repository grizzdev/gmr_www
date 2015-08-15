<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model {

	use SoftDeletes;

	protected $table = 'coupons';

	protected $fillable = [
		'code',
		'type',
		'amount',
		'uses',
		'used',
		'minimum_amount',
		'before_tax',
		'products_json',
		'categories_json',
		'users_json',
		'expires_at'
	];

	protected $dates = [
		'deleted_at',
		'expires_at'
	];

	public function getProductsAttribute() {
		return json_decode($this->products_json);
	}

	public function setProductsAttribute($data = []) {
		$this->products_json = json_encode($data);
	}

	public function getCategoriesAttribute() {
		return json_decode($this->categories_json);
	}

	public function setCategoriesAttribute($data = []) {
		$this->categories_json = json_encode($data);
	}

	public function getUsersAttribute() {
		return json_decode($this->users_json);
	}

	public function setUsersAttribute($data = []) {
		$this->users_json = json_encode($data);
	}

}
