<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller {

	public function index() {
		return view('my-account.index', [
			'title' => 'My Account',
			'user' => Auth::user(),
			'orders' => Auth::user()->orders()->orderBy('created_at', 'desc')->limit(5)->get(),
			'logs' => Auth::user()->logs()->orderBy('created_at', 'desc')->limit(5)->get()
		]);
	}

	public function save(Request $request) {
		$user = Auth::user();
		$changed = false;

		if (!empty($request->input('name')) && $request->input('name') != $user->name) {
			$user->name = $request->input('name');
			$changed = true;
		}

		if (!empty($request->input('email')) && $request->input('email') != $user->email) {
			$user->email = $request->input('email');
			$changed = true;
		}

		if (!empty($request->input('password')) && !empty($request->input('password_confirmation'))) {
			if ($request->input('password') != $request->input('password_confirmation')) {
				return \Response::json(['error' => 'Passwords do not match.']);
			} else {
				$user->password = Hash::make($request->input('password'));
				$changed = true;
			}
		}

		if ($changed) {
			$user->save();
		}

		return \Response::json([]);
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

	public function logs() {
		return view('my-account.logs', [
			'title' => 'My Logs',
			'user' => Auth::user(),
			'logs' => Auth::user()->logs()->paginate(20),
			'paginate' => true
		]);
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
