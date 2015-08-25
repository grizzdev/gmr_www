<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class PaymentMethod extends Model implements SluggableInterface {

	use SoftDeletes, SluggableTrait;

	protected $table = 'payment_methods';

	protected $fillable = [
		'name',
		'slug'
	];

	protected $dates = [
		'deleted_at'
	];

	protected $sluggable = [
		'build_from' => 'name',
		'save_to' => 'slug',
	];

}
