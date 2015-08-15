<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Category extends Model implements SluggableInterface {

	use SoftDeletes, SluggableTrait;

	protected $table = 'categories';

	protected $fillable = [
		'name',
		'slug',
		'description',
		'file_id',
		'parent_id'
	];

	protected $dates = [
		'deleted_at'
	];

	protected $sluggable = [
		'build_from' => 'name',
		'save_to' => 'slug',
	];

	public function file() {
		return $this->belongsTo('App\File');
	}

	public function parent() {
		return $this->belongsTo('App\Category', 'parent_id');
	}

	public function children() {
		return $this->hasMany('App\Category', 'parent_id');
	}

	public function products() {
		return $this->belongsTo('App\Product');
	}

}
