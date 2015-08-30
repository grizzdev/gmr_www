<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemAttribute extends Model {

	protected $table = 'item_attributes';

	protected $fillable = [
		'item_id',
		'attribute_id',
		'value'
	];

	public function attribute() {
		return $this->belongsTo('\App\Attribute');
	}

}
