<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, BillableContract {

	use Authenticatable, CanResetPassword, EntrustUserTrait, Billable;

	protected $table = 'users';

	protected $fillable = [
		'name',
		'email',
		'password'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $dates = [
		'trial_ends_at',
		'subscription_ends_at'
	];

	public function orders() {
		return $this->hasMany('\App\Order');
	}

	public function logs() { // logs about the user's account
		return $this->morphMany('\App\Log', 'loggable');
	}

	//addresses
	//cards
	//new orders
	//cart

	public function sendPasswordEmail() {
		/*
		Mail::queue(
			[
				'emails.user.create-html',
				'emails.user.create-text'
			],
			[
				'logo' => config('mail.view.logo'),
				'name' => $user->name,
				'email' => $user->email,
				'password' => $password
			],
			function ($message) use ($user) {
				$message->to($user->email)->subject('Your Gamerosity Account');
			}
		);
		*/
	}

}
