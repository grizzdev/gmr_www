<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Product extends Model implements SluggableInterface {

	use SoftDeletes, SluggableTrait;

	protected $table = 'products';

	protected $fillable = [
		'name',
		'sku',
		'description',
		'short_description',
		'cost',
		'price',
		'sale_price',
		'contribution_amount',
		'total_sales_count',
		'total_sales_amount'
	];

	protected $dates = [
		'deleted_at'
	];

	protected $sluggable = [
		'build_from' => 'name',
		'save_to' => 'sku',
	];

	public function files() {
		return $this->belongsToMany('App\File')->withTimestamps();
	}

	public function categories() {
		return $this->belongsToMany('App\Category')->withTimestamps();
	}

	public function tags() {
		return $this->belongsToMany('App\Tag')->withTimestamps();
	}

	public function attributes() {
		return $this->belongsToMany('App\Attribute')->withTimestamps();
	}

	public function cost() {
		$cost = $this->price;

		foreach ($this->attributes() as $attribute) {
			$cost += $attribute->price;
		}

		return $cost;
	}

	public static function popular($num = -1) {
		return self::where('active', '=', 1)->orderBy('total_sales_count')->limit($num)->get();
	}

	public static function totals() {
		$count = 0;
		$sales = 0;

		foreach (\App\Order::whereNotIn('status_id', [5,6])->get() as $order) {
			foreach ($order->cart as $item) {
				if ($item->product_id == self::$id) {
					$count++;
					$sales += ($item->price * $item->quantity);
					foreach ($item->attributes as $attribute) {
						foreach ($attribute->options as $option) {
							if (!empty($option->price)) {
								$sales += $option->price;
							}
						}
					}
				}
			}
		}

		return [
			'count' => $count,
			'sales' => $sales
		];
	}

	public function is_donation() {
		if (in_array($this->id, [1, 220])) {
			return true;
		} else {
			return false;
		}
	}

}
