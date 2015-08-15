<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Tag extends Model implements SluggableInterface {

	use SoftDeletes, SluggableTrait;

	protected $table = 'tags';

	protected $fillable = [
		'name',
		'slug',
		'description'
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

}
