<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller {

	public function index() {
		return view('my-account.index', [
			'title' => 'My Account',
			'user' => Auth::user(),
			'orders' => Auth::user()->orders()->orderBy('created_at', 'desc')->limit(5)->get()
		]);
	}

	public function orders() {
		return view('my-account.orders', [
			'title' => 'My Orders',
			'user' => Auth::user(),
			'orders' => Auth::user()->orders()->paginate(20),
			'paginate' => true
		]);
	}

	public function order($id) {
		$order = Auth::user()->orders()->where('id', $id)->first();

		if (!empty($order->id)) {
			$checkout = (array) $order->checkout;

			return view('my-account.order', [
				'title' => 'Order #'.$order->id,
				'order' => $order,
				'checkout' => $checkout,
				'cart' => (array) $order->cart,
				'meta' => (array) $order->meta,
				'billing_state' => \App\Location::find($checkout['billing-state-id']),
				'billing_country' => \App\Location::find($checkout['billing-country-id']),
				'shipping_state' => \App\Location::find($checkout['shipping-state-id']),
				'shipping_country' => \App\Location::find($checkout['shipping-country-id'])
			]);
		} else {
			return redirect('my-account');
		}
	}

	public function cancelOrder($id) {
		if (Auth::check()) {
			$order = Auth::user()->orders()->where('id', $id)->first();

			if (!empty($order->id)) {
				$order->status_id = \App\Status::where('name', '=', 'Cancelled')->first()->id;
				$order->save();
			}
		}
	}

}
