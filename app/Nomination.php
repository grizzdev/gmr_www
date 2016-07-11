<?php

namespace App;

use Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomination extends Model {

	use SoftDeletes;

	protected $table = 'nominations';

	protected $fillable = [
		'name',
		'email_address',
		'phone_number',
		'overview',
		'description',
		'birth_date',
		'gender',
		'address',
		'city',
		'state_id',
		'zip',
		'shirt_size',
		'hospital_name',
		'hospital_location',
		'cancer_type',
		'facebook_url',
		'twitter_url',
		'youtube_url',
		'caringbridge_url',
		'file_id',
		'nominee_id',
		'relationship'
	];

	protected $dates = [
		'deleted_at',
		'birth_date'
	];

	public function file() {
		return $this->belongsTo('App\File');
	}

	public function nominee() {
		return $this->belongsTo('App\User', 'nominee_id');
	}

	public function approve() {
		// convert to hero
		// delete nomination
		// return hero id
	}

	public function deny() {
		// delete nomination
	}

	public function sendEmail() {
		Mail::queue(
			[
				'emails.nomination-html',
				'emails.nomination-text'
			],
			[
				'title' => 'New Hero Nomination',
				'logo' => config('mail.view.logo'),
				'nominee' => $this,
				'user' => $this->nominee
			],
			function ($message) {
				//$message->to('info@gamerosity.com')->subject('New Hero Nomination');
				$message->to('kevin@grizzdev.com')->subject('New Hero Nomination');
			}
		);
	}

}
