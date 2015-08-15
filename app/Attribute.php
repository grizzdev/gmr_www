<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Attribute extends Model implements SluggableInterface {

	use SoftDeletes, SluggableTrait;

	protected $table = 'attributes';

	protected $fillable = [
		'name',
		'slug',
		'description',
		'price',
		'parent_id'
	];

	protected $dates = [
		'deleted_at'
	];

	protected $sluggable = [
		'build_from' => 'name',
		'save_to' => 'slug',
	];

	public function products() {
		return $this->belongsToMany('App\Product')->withTimestamps();
	}

	public function parent() {
		return $this->belongsTo('App\Attribute', 'parent_id');
	}

	public function children() {
		return $this->hasMany('App\Attribute', 'parent_id');
	}

}
