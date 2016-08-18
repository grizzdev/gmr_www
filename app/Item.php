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
		'hero_id',
		'cart_id'
	];

	protected $dates = [
		'deleted_at'
	];

	protected $casts = [
		'product_id' => 'integer',
		'quantity' => 'integer',
		'hero_id' => 'integer',
		'cart_id' => 'integer'
	];

	public function product() {
		return $this->belongsTo('\App\Product');
	}

	public function hero() {
		return $this->belongsTo('\App\Hero');
	}

	public function itemAttributes() {
		return $this->hasMany('\App\ItemAttribute');
	}

	public function price() {
		$price = (!empty($this->product->sale_price)) ? $this->product->sale_price : $this->product->price;

		foreach ($this->itemAttributes as $attribute) {
			if ($attribute->attribute->name == 'Amount') {
				$price += $attribute->value;
			} elseif ($attribute->attribute->price) {
				$price += $attribute->attribute->price;
			} elseif ($attribute->attribute->type == 'select') {
				$attr = \App\Attribute::find($attribute->value);
				if ($attr->price) {
					$price += $attr->price;
				}
			}
		}

		return $price;
	}

	public function contribution() {
		if ($this->product->id == 1) { // donation
			return $this->price();
		} else {
			return ($this->product->contribution_amount * $this->quantity);
		}
	}
	
}
