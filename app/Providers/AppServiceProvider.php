<?php

namespace App\Providers;

use Mail;
use App\User;
use App\Order;
use App\Log;
use App\Status;
use App\Location;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		Order::saving(function($order) {
			// Order status change
			if ($order->getOriginal('status_id') != $order->status_id && $order->status_id != 1) {
				$old_status = Status::find($order->getOriginal('status_id'));
				Log::create([
					'user_id' => Auth::user()->id,
					'loggable_id' => $order->id,
					'loggable_type' => 'App\Order',
					'data' => 'Changed Status from '.$old_status->name.' to '.$order->status->name
				]);

				$user = User::find($order->user_id);
				$checkout = (array) $order->checkout;

				if ($order->status_id == 3) {
					// send order shipped email
				} elseif ($order->status_id == 5) {
					// send order cancelled email
					Mail::queue('emails.order.cancel-html', [
						'title' => 'Gamerosity Order #'.$order->id.' - CANCELLED',
						'logo' => config('mail.view.logo'),
						'order' => $order,
						'billing_state' => Location::find($checkout['billing-state-id']),
						'billing_country' => Location::find($checkout['billing-country-id']),
						'shipping_state' => Location::find($checkout['shipping-state-id']),
						'shipping_country' => Location::find($checkout['shipping-country-id']),
						'status' => $order->status->name,
						'contribution' => $order->contribution()
					], function ($message) use ($user, $order) {
						$message->to($user->email)->subject('Your Gamerosity Order: #'.$order->id.' has been cancelled');
						$message->bcc('info@gamerosity.com')->subject('Your Gamerosity Order: #'.$order->id.' has been cancelled');
						$message->bcc('kevin@grizzdev.com')->subject('Your Gamerosity Order: #'.$order->id.' has been cancelled');
					});
				} elseif ($order->status_id == 6) {
					// send order refunded email
				} elseif ($order->status_id = 7) {
					// send order charged email
				} elseif ($order->status_id == 8) {
					// send order declined email
				}
			}
		});


		User::created(function($user) {
			Log::create([
				'user_id' => $user->id,
				'loggable_id' => $user->id,
				'loggable_type' => 'App\User',
				'data' => 'Account Created'
			]);
		});

		User::saving(function($user) {
			if (!empty($user->getOriginal('name')) && $user->getOriginal('name') != $user->name) {
				Log::create([
					'user_id' => (Auth::check()) ? Auth::user()->id : $user->id,
					'loggable_id' => $user->id,
					'loggable_type' => 'App\User',
					'data' => 'Changed Name from '.$user->getOriginal('name').' to '.$user->name
				]);
			}

			if (!empty($user->getOriginal('email')) && $user->getOriginal('email') != $user->email) {
				Log::create([
					'user_id' => (Auth::check()) ? Auth::user()->id : $user->id,
					'loggable_id' => $user->id,
					'loggable_type' => 'App\User',
					'data' => 'Changed Email from '.$user->getOriginal('email').' to '.$user->email
				]);
			}

			if (!empty($user->getOriginal('password')) && $user->getOriginal('password') != $user->password) {
				Log::create([
					'user_id' => (Auth::check()) ? Auth::user()->id : $user->id,
					'loggable_id' => $user->id,
					'loggable_type' => 'App\User',
					'data' => 'Changed Password'
				]);
			}
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
	}

}
