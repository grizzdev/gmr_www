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

	public function user() {
		return $this->belongsTo('\App\User');
	}

	public function coupon() {
		return $this->belongsTo('\App\Coupon');
	}

	public function subtotal() {
		$subtotal = 0;

		foreach ($this->items as $item) {
			$subtotal += ($item->price() * $item->quantity);
		}

		return $subtotal;
	}

	public function shipping() {
		$base_shipping = 0;
		$lightweight = 0; // (bracelets, stickers, etc) $2 for first item, $.50 for each additional
		$garments = 0; // $5.50 for first item, $1.50 each additional
		$hats = 0; // $7 for first item, $1.50 for each additional
		$hoodies = 0; // $8 for first item, $2.50 for each additional
		$stuffies = 0; // $4 each
		$lightweights = ['Bracelets'];

		foreach ($this->items as $item) {
			if ($item->product->name != 'Donate') {
				foreach ($item->product->categories as $category) {
					if ($category->name == 'Hats') {
						if ($base_shipping < 7) {
							$base_shipping = 7;
						}
						$hats += $item->quantity;
					} elseif ($category->name == 'Garments') {
						if ($base_shipping < 5.5) {
							$base_shipping = 5.5;
						}
						$garments += $item->quantity;
					} elseif ($category->name == 'Sweats') {
						if ($base_shipping < 8) {
							$base_shipping = 8;
						}
						$hoodies += $item->quantity;
					} elseif (in_array($category->name, $lightweights)) {
						if ($base_shipping < 2) {
							$base_shipping = 2;
						}
						$lightweight += $item->quantity;
					} elseif ($item->product->id == 213) { // Stuffie
						$stuffies++;
					}
				}
			}
		}

		$shipping = $base_shipping;

		if ($base_shipping == 2) {
			$lightweight--;
		} elseif ($base_shipping == 5.5) {
			$garments--;
		} elseif ($base_shipping == 7) {
			$hats--;
		} elseif ($base_shipping == 8) {
			$hoodies--;
		}

		for ($i = 0; $i < $lightweight; $i++) {
			$shipping += .5;
		}

		for ($i = 0; $i < $garments; $i++) {
			$shipping += 1.5;
		}

		for ($i = 0; $i < $hats; $i++) {
			$shipping += 1.5;
		}

		for ($i = 0; $i < $hoodies; $i++) {
			$shipping += 2.5;
		}

		for ($i = 0; $i < $stuffies; $i++) {
			$shipping += 4;
		}

		return $shipping;
	}

	public function discount() {
		$discount = 0;

		if ($this->coupon) {
			switch ($this->coupon->type) {
				case 'shipping':
					if ($this->subtotal() >= $this->coupon->amount) {
						$discount = $this->shipping();
					}
					break;
				case 'fixed':
					$discount = $this->coupon->amount;
					break;
				case 'percentage':
					$discount = number_format(($this->subtotal() * $this->coupon->amount), 2, '.', '');
					break;
			}
		}

		return $discount;
	}

	public function total() {
		return ($this->subtotal() + $this->shipping() - $this->discount());
	}

	public function count() {
		return $this->items->count();
	}

	public function items() {
		return $this->hasMany('\App\Item');
	}

	public function contribution($hero_id = null) {
		$contribution = 0;

		foreach ($this->items as $item) {
			if (empty($hero_id) || $item->hero_id == $hero_id) {
				$contribution += $item->contribution();
			}
		}

		return $contribution;
	}

	public function add($product_id, $quantity = 1, $hero_id = null, $attributes) {
		$item = Item::where('cart_id', '=', $this->id)
			->where('product_id', '=', $product_id)
			->where('hero_id', '=', $hero_id)
			->whereHas('itemAttributes', function($query) use ($attributes) {
				foreach ($attributes as $id => $value) {
					if ($id != 39) {
						$query->where('attribute_id', '=', $id)->where('value', '=', $value);
					}
				}
			})
			->first();

		if ($item) {
			$item->quantity += $quantity;
			$item->save();
		} else {
			$item = Item::Create([
				'cart_id' => $this->id,
				'product_id' => $product_id,
				'quantity' => $quantity,
				'hero_id' => $hero_id
			]);

			foreach ($attributes as $id => $value) {
				if ($id != 39) {
					ItemAttribute::Create([
						'item_id' => $item->id,
						'attribute_id' => $id,
						'value' => $value
					]);
				}
			}
		}
	}

	public function remove($item_id) {
	}

	//public function update($item_id, $quantity) {
	//}

}
