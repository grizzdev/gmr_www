<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {

	protected $table = 'orders';

	protected $fillable = [
		'checkout_json',
		'cart_json',
		'meta_json',
		'user_id',
		'status_id'
	];

	protected $dates = [
		'deleted_at'
	];

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function status() {
		return $this->belongsTo('App\Status');
	}

	public function getCheckoutAttribute() {
		return json_decode($this->checkout_json);
	}

	public function setCheckoutAttribute($data) {
		$this->checkout_json = json_encode($data);
	}

	public function getCartAttribute() {
		return json_decode($this->cart_json);
	}

	public function setCartAttribute($data) {
		$this->cart_json = json_encode($data);
	}

	public function getMetaAttribute() {
		return json_decode($this->meta_json);
	}

	public function setMetaAttribute($data) {
		$this->meta_json = json_encode($data);
	}

	public function contribution() {
		$contribution = 0;

		foreach ($this->cart as $item) {
			if (!empty($item->contribution)) {
				$contribution += $item->contribution;
			} elseif($item->sku == 'donate') {
				foreach ($item->attributes as $attr) {
					if ($attr->name == 'Amount') {
						$contribution += $attr->value;
					}
				}
			}
		}

		return number_format($contribution, 2, '.', '');
	}

	public function logs() {
		return $this->morphMany('\App\Log', 'loggable');
	}

}
