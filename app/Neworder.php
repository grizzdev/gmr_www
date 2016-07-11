<?php

namespace App;

use HashIDs;
use Mail;
use Illuminate\Database\Eloquent\Model;

class Neworder extends Model {

	protected $table = 'neworders';

	protected $fillable = [
		'user_id',
		'cart_id',
		'payment_method_id',
		'payment_token',
		'payer_id',
		'payment_id',
		'payment_status_id',
		'status_id',
		'billing_address_id',
		'shipping_address_id',
		'notes',
		'meta'
	];

	protected $casts = [
		'user_id' => 'integer',
		'cart_id' => 'integer',
		'payment_method_id' => 'integer',
		'payment_status_id' => 'integer',
		'status_id' => 'integer',
		'billing_address_id' => 'integer',
		'shipping_address_id' => 'integer'
	];

	public function cart() {
		return $this->belongsTo('\App\Cart', 'cart_id');
	}

	public function user() {
		return $this->belongsTo('\App\User', 'user_id');
	}

	public function billing_address() {
		return $this->belongsTo('\App\Address', 'billing_address_id');
	}

	public function shipping_address() {
		return $this->belongsTo('\App\Address', 'shipping_address_id');
	}

	public function payment_method() {
		return $this->belongsTo('\App\PaymentMethod', 'payment_method_id');
	}

	public function payment_status() {
		return $this->belongsTo('\App\Status', 'payment_status_id');
	}

	public function status() {
		return $this->belongsTo('\App\Status', 'status_id');
	}

	public function subtotal() {
		return $this->cart->subtotal();
	}

	public function shipping() {
		return $this->cart->shipping();
	}

	public function discount() {
		return $this->cart->discount();
	}

	public function total() {
		return $this->cart->total();
	}

	public function count() {
		return $this->cart->count();
	}

	public function contribution($hero_id = null) {
		return $this->cart->contribution($hero_id);
	}

	public function card() {
	}

	public function sendEmail($tos = []) {
		$order = $this;
		//\Mail::queue('emails.order.create-html', [
		Mail::send('emails.order.create-html', [
			'title' => 'Gamerosity Order #'.$this->id,
			'logo' => config('mail.view.logo'),
			'order' => $order,
		], function ($message) use ($order) {
			$message->to($order->user->email)->subject('Your Gamerosity Order');
			$message->bcc('info@gamerosity.com')->subject('Your Gamerosity Order');
			//$message->bcc('kevin@grizzdev.com')->subject('Your Gamerosity Order');
		});
	}

	public function hash() {
		return HashIDs::encode($this->id);
	}

	public function log($user_id, $data) {
	}

	public function taxes() {
	}

}
