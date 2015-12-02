<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use App\File;
use DB;
use Mail;

class HomeController extends Controller {

	public function test(Request $request) {
		echo '<pre>';

		$allowed = [
			'127.0.0.1',
			'10.0.4.1',
			'65.103.70.94',
			'96.41.139.50',
			'207.109.248.12',
			'71.92.128.183'
		];
		if (!in_array($request->ip(), $allowed)) {
			return Redirect::to('/');
		} else {
			/*
			// PayPal processing
			$orders = \App\Neworder::where('payment_method_id', '=', 2)->where('status_id', '=', 1)->get();

			foreach ($orders as $order) {
				echo $order->id."\n";

				$response = (new Client())->get(config('services.paypal.url'), [
					'verify' => false,
					'query' => [
						'USER' => config('services.paypal.user'),
						'PWD' => config('services.paypal.pwd'),
						'SIGNATURE' => config('services.paypal.signature'),
						'METHOD' => 'DoExpressCheckoutPayment',
						'VERSION' => 93,
						'TOKEN' => $order->payment_token,
						'PAYERID' => $order->payer_id,
						'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
						'PAYMENTREQUEST_0_AMT' => $order->total(),
						'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
					]
				]);

				print_r($response);
				echo "\n\n";
				exit();
			}
			*/

			/*
			// let's do some work
			\Stripe\Stripe::setApiKey(config('services.stripe.secret'));

			$orders = \App\Neworder::where('payment_method_id', '=', 1)->whereNotNull('payment_token')->where('payment_status_id', '=', 1)->where('status_id', '=', 1)->get();

			foreach ($orders as $order) {
				$charge_data = [
					'source' => $order->payment_token,
					'amount' => ($order->cart->total() * 100),
					'currency' => 'usd',
					'description' => 'Gamerosity Order #'.$order->id
				];

				echo "Order: {$order->id}\n";
				echo "Total: ".($order->cart->total() * 100)."\n";
				echo "Charge: ";
				print_r($charge_data);
				echo "\n";

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
			*/
		}
		echo '</pre>';
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
			$filename = time().'-'.$request->file('image')->getClientOriginalName();

			$file = File::create([
				'path' => $path,
				'name' => $filename,
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

			$request->file('image')->move(public_path().$path, $filename);
		}

		return json_encode(['image' => $result]);
	}

}
