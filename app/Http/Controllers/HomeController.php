<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\File;

class HomeController extends Controller {

	public function test(Request $request) {
		$allowed = [
			'127.0.0.1',
			'10.0.4.1',
			 '65.103.70.94'
		];
		exit();

		if (!in_array($request->ip(), $allowed)) {
			return Redirect::to('/');
		} else {
			// let's do some work
			\Stripe\Stripe::setApiKey(config('services.stripe.secret'));

			$orders = \App\Order::where('status_id', '=', 1)->where('checkout_json', 'LIKE', '%payment-type":"stripe%')->where('created_at', '>', '2015-08-01')->get();

			$paymenttoken = 'payment-token';
			$ccnumber = 'credit-card-number';
			$ccexmonth = 'credit-card-expiration-month';
			$ccexyear = 'credit-card-expiration-year';

			foreach ($orders as $order) {
				$subtotal = 0;
				echo '<pre>';
				if (isset($order->checkout->$paymenttoken)) {
					if ($order->checkout->$paymenttoken == 'true') {
						$card = [
							'number' => ((empty($order->checkout->$ccnumber)) ? '4242424242424242' : $order->checkout->$ccnumber),
							'exp_month' => ((empty($order->checkout->$ccexmonth)) ? 09 : $order->checkout->$ccexmonth),
							'exp_year' => ((empty($order->checkout->$ccexyear)) ? 2016 : $order->checkout->$ccexyear),
						];

						$amount = ($order->checkout->total * 100);

						$charge_data = [
							'card' => $card,
							'amount' => $amount,
							'currency' => 'usd',
							'description' => 'Gamerosity Order #'.$order->id
						];
					} elseif (preg_match('/tok_/', $order->checkout->$paymenttoken)) {
						$amount = ($order->checkout->total * 100);
						$charge_data = [
							'source' => $order->checkout->$paymenttoken,
							'amount' => $amount,
							'currency' => 'usd',
							'description' => 'Gamerosity Order #'.$order->id
						];
					}

					echo "Order: {$order->id}\n";
					echo "Total: $amount\n";

					try {
						$charge = \Stripe\Charge::create($charge_data);
						echo "Charge: $charge\n";
					} catch(\Stripe\Error\Card $e) {
						// Since it's a decline, \Stripe\Error\Card will be caught
						$body = $e->getJsonBody();
						$err  = $body['error'];

						print('Status is:' . $e->getHttpStatus() . "\n");
						print('Type is:' . $err['type'] . "\n");
						print('Code is:' . $err['code'] . "\n");
						// param is '' in this case
						//print('Param is:' . $err['param'] . "\n");
						print('Message is:' . $err['message'] . "\n");
					} catch (\Stripe\Error\InvalidRequest $e) {
						// Invalid parameters were supplied to Stripe's API
						$body = $e->getJsonBody();
						$err  = $body['error'];

						print('Status is:' . $e->getHttpStatus() . "\n");
						print('Type is:' . $err['type'] . "\n");
						//print('Code is:' . $err['code'] . "\n");
						// param is '' in this case
						//print('Param is:' . $err['param'] . "\n");
						print('Message is:' . $err['message'] . "\n");
					} catch (\Stripe\Error\Authentication $e) {
						// Authentication with Stripe's API failed
						// (maybe you changed API keys recently)
					} catch (\Stripe\Error\ApiConnection $e) {
						// Network communication with Stripe failed
					} catch (\Stripe\Error\Base $e) {
						// Display a very generic error to the user, and maybe send
						// yourself an email
					} catch (Exception $e) {
						// Something else happened, completely unrelated to Stripe
					}
				}
				echo '</pre>';
			}
		}
	}

	public function home() {
		return view('home.home', ['title' => 'Home']);
	}

	public function robots() {
		return response(view('home.robots'))->header('Content-Type', 'text/plain');
	}

	public function humans() {
		return response(view('home.humans'))->header('Content-Type', 'text/plain');
	}

	public function crossdomain() {
		return response(view('home.crossdomain'))->header('Content-Type', 'application/xml');
	}

	public function upload(Request $request) {
		$result = [];

		if ($request->hasFile('image') && $request->file('image')->isValid()) {
			$path = '/uploads/'.date('Y').'/'.date('m').'/';

			$file = File::create([
				'path' => $path,
				'name' => $request->file('image')->getClientOriginalName(),
				'mime' => $request->file('image')->getMimeType(),
				'size' => $request->file('image')->getClientSize()
			]);

			$result = [
				'id' => $file->id,
				'path' => $file->path,
				'name' => $file->name,
				'mime' => $file->mime,
				'size' => $file->size
			];

			$request->file('image')->move(public_path().$path, $request->file('image')->getClientOriginalName());
		}

		return json_encode(['image' => $result]);
	}

}
