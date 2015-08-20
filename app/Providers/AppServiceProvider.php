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
		Order::saving(function ($order) {
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
					Mail::queue(
						[
							'emails.order.cancel-html',
							'emails.order.cancel-text'
						],
						[
							'title' => 'Gamerosity Order #'.$order->id.' - CANCELLED',
							'logo' => config('mail.view.logo'),
							'order' => $order,
							'billing_state' => Location::find($checkout['billing-state-id']),
							'billing_country' => Location::find($checkout['billing-country-id']),
							'shipping_state' => Location::find($checkout['shipping-state-id']),
							'shipping_country' => Location::find($checkout['shipping-country-id']),
							'status' => $order->status->name,
							'contribution' => $order->contribution()
						],
						function ($message) use ($user, $order) {
							$message->to($user->email)->subject('Your Gamerosity Order: #'.$order->id.' has been cancelled');
							$message->to('info@gamerosity.com')->subject('Your Gamerosity Order: #'.$order->id.' has been cancelled');
						}
					);
					// send order cancelled email
				} elseif ($order->status_id == 6) {
					// send order refunded email
				} elseif ($order->status_id = 7) {
					// send order charged email
				} elseif ($order->status_id == 8) {
					// send order declined email
				}
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
