<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model {

	use SoftDeletes;

	protected $table = 'files';

	protected $fillable = [
		'path',
		'name',
		'mime',
		'size'
	];

	protected $dates = [
		'deleted_at'
	];

	public function url() {
		return $this->path.$this->name;
	}

}
