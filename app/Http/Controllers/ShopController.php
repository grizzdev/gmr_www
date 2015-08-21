<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product as Product;
use App\File as File;
use App\Category as Category;
use App\Tag as Tag;
use App\Attribute as Attribute;
use App\Location as Location;
use App\Order as Order;
use App\User as User;
use App\Coupon as Coupon;
use App\Package as Package;
use App\Hero as Hero;
use App\Status as Status;
use App\Shop as Shop;
use App\Log as Log;
use View;
use Response;
use GuzzleHttp\Client as Client;
use Agent;
use HashIDs;
use Hash;
use Mail;
use DB;

class ShopController extends Controller {

	public function shop($a = null, $b = null, $c = null, $d = null, $e = null, $f = null, $g = null, $h = null, $i = null, $j = null) {
		$options = [$a, $b, $c, $d, $e, $f, $g, $h, $i, $j];

		$slugs = ['category' => null, 'hero' => null, 'sort' => null, 'tag' => null, 'search' => null];

		for ($o = 0; $o < count($options); $o++) {
			switch ($options[$o]) {
				case 'category':
					$slugs['category'] = $options[($o + 1)];
					$o++;
					break;
				case 'tag':
					$slugs['tag'] = $options[($o + 1)];
					$o++;
					break;
				case 'sort':
					$slugs['sort'] = $options[($o + 1)];
					$o++;
					break;
				case 'search':
					$slugs['search'] = $options[($o + 1)];
					$o++;
					break;
				case 'hero':
					$slugs['hero'] = $options[($o + 1)];
					$o++;
					break;
				default:
					break;
			}
		}

		if ($slugs['hero']) {
			session(['hero_slug' => $slugs['hero']]);
		}

		$products = $this->getProducts($slugs);

		foreach (Category::where('slug', '!=', 'no-shop-display')->get() as $category) {
			$categories[$category->slug] = $category->name;
		}

		return view('shop.shop', [
			'title' => 'Shop',
			'products' => $products,
			'categories' => $categories,
			'slugs' => $slugs
		]);
	}

	public function product($sku, $hero_slug = null) {
		$product = Product::where('sku', '=', $sku)->first();

		if ($hero_slug) {
			session(['hero_slug' => $hero_slug]);
		}

		if (!empty($product->id)) {
			return view('shop.product', [
				'title' => $product->name,
				'product' => $product,
				'hero' => (!empty($hero_slug)) ? Hero::where('slug', '=', $hero_slug)->first() : null
			]);
		} else {
			return redirect('');
		}
	}

	public function cart(Request $request) {
		$items = $request->session()->get('cart');

		return view('shop.cart', [
			'title' => 'Cart',
			'cart' => $this->buildItemsForView($items)
		]);
	}

	public function updateCart(Request $request) {
		$items = $request->session()->get('cart');
		$cart = $request->input('cart');

		if (!empty($request->input('coupon_code'))) {
			session(['coupon' => $request->input('coupon_code')]);
		}

		foreach ($cart as $key => $quantity) {
			if ($quantity) {
				$items[$key]['quantity'] = $quantity;
			} else {
				unset($items[$key]);
			}
		}

		$request->session()->put('cart', $items);

		return Response::json([
			'view' => View::make('includes.cart', [
				'cart' => $this->buildItemsForView($items),
			])->render(),
			'count' => count($items)
		]);
	}

	public function deleteCart(Request $request, $key) {
		$items = $request->session()->get('cart');
		unset($items[$key]);

		$request->session()->put('cart', $items);

		return Response::json([
			'view' => View::make('includes.cart', [
				'cart' => $this->buildItemsForView($items)
			])->render(),
			'count' => count($items)
		]);
	}

	public function addCart(Request $request) {
		$cart = $request->session()->get('cart');
		$exists = null;
		$attributes = [];
		$quantity = $request->input('quantity');

		if (!empty($request->input('attributes'))) {
			$attributes = $request->input('attributes');
		}

		if (is_array($cart)) {
			foreach ($cart as $key => $item) {
				if ($item['product_id'] == $request->input('product_id') && $item['attributes'] == $attributes) {
					$exists = $key;
				}
			}
		}

		if (!is_null($exists)) {
			$cart[$exists]['quantity'] = ($cart[$exists]['quantity'] + $quantity);
		} else {
			$cart[microtime(true)] = [
				'product_id' => $request->input('product_id'),
				'attributes' => $attributes,
				'quantity' => $quantity,
			];
		}

		$request->session()->put('cart', $cart);

		if (session('hero_slug')) {
			$hero = Hero::where('slug', '=', session('hero_slug'))->first();
			$contribution = $hero->contribution_in_cart();
			$percentage = floor((($hero->raised + $contribution) / $hero->goal) * 100);
		} else {
			$contribution = 0;
			$percentage = 0;
		}

		return Response::json([
			'count' => count($cart),
			'contribution' => $contribution,
			'percentage' => $percentage
		]);
	}

	public function checkout(Request $request) {
		$countries = [];
		$states = [];
		$items = $request->session()->get('cart');

		if (empty($items)) {
			return redirect(url('cart'));
		}

		$lcountries = Location::countries();
		foreach ($lcountries as $country) {
			$countries[$country->id] = $country->name;
		}

		$lstates = Location::states(224);
		foreach ($lstates as $state) {
			$states[$state->id] = $state->name;
		}

		$months = [
			1 => 'January',
			2 => 'February',
			3 => 'March',
			4 => 'April',
			5 => 'May',
			6 => 'June',
			7 => 'July',
			8 => 'August',
			9 => 'September',
			10 => 'October',
			11 => 'November',
			12 => 'December'
		];

		$years = [];
		for ($i = date('Y'); $i < (date('Y') + 11); $i++) {
			$years[$i] = $i;
		}

		return view('shop.checkout', [
			'title' => 'Checkout',
			'cart' => $this->buildItemsForView($items),
			'countries' => $countries,
			'states' => $states,
			'months' => $months,
			'years' => $years
		]);
	}

	public function states(Request $request) {
		if (!empty($request->input('country_id')) && !empty($request->input('name'))) {
			$states = [];

			$lstates = Location::states($request->input('country_id'));
			foreach ($lstates as $state) {
				$states[$state->id] = $state->name;
			}

			return view('includes.state-select', [
				'name' => $request->input('name'),
				'attributes' => [
					'class' => 'form-control',
					'id' => $request->input('name'),
					'disabled' => $request->input('disabled')
				],
				'states' => $states,
				'selected' => $request->input('selected'),
			]);
		}
	}

	public function postCheckout(Request $request) {
		$checkout = $request->session()->get('checkout');

		foreach ($request->all() as $key => $val) {
			$checkout[$key] = $val;
		}

		if (!empty($checkout['same-as-billing'])) {
			$checkout['shipping-country-id'] = $checkout['billing-country-id'];
			$checkout['shipping-address-1'] = $checkout['billing-address-1'];
			$checkout['shipping-address-2'] = $checkout['billing-address-2'];
			$checkout['shipping-city'] = $checkout['billing-city'];
			$checkout['shipping-state-id'] = $checkout['billing-state-id'];
			$checkout['shipping-zip'] = $checkout['billing-zip'];
		}

		$request->session()->put('checkout', $checkout);

		if ($request->input('payment-type') == 'paypal' && !empty($request->input('payment-token'))) {
		} else {
			$cart = $request->session()->get('cart');
			$items = [];

			foreach ($cart as $item) {
				$product = Product::find($item['product_id']);

				$attributes = [];
				foreach ($item['attributes'] as $id => $value) {
					$attribute = Attribute::find($id);
					if ($attribute) {
						switch ($attribute->type) {
							case 'text':
							case 'number':
								$value = $attribute['value'];
								break;
							case 'select':
								$value = \App\Attribute::find($value)->name;
							case 'model':
								if (!empty($attribute->model)) {
									$modelname = "\\App\\{$attribute->model}";
									$model = $modelname::find($value);
									$value = $model->name;

									/*if ($attribute->model == 'Hero') {
										if ($product->id == 1) {
											$raised = ($model->raised + $item['attributes'][38]);
										} else {
											$raised = ($model->raised + $product->contribution_amount);
										}

										$model->raised = $raised;
										$model->save();
									}*/
								}
								break;
						}

						$attributes[] = [
							'name' => $attribute->name,
							'value' => $value
						];
					}
				}

				$items[] = [
					'name' => $product->name,
					'sku' => $product->sku,
					'price' => (empty($item['price'])) ? $product->price : $item['price'],
					'contribution' => $product->contribution_amount,
					'attributes' => $attributes,
					'quantity' => $item['quantity']
				];
			}

			if (!empty($request->session()->get('checkout.gamerosity-donation'))) {
				$items[] = [
					'name' => 'Gamerosity Donation',
					'sku' => 'gamerosity-donation',
					'price' => $request->session()->get('checkout.gamerosity-donation'),
					'contribution' => 0,
					'file_id' => null,
					'attributes' => [],
					'quantity' => 1
				];
			}

			$browser = Agent::browser();
			$platform = Agent::platform();
			$meta = [
				'mobile' => Agent::isMobile(),
				'tablet' => Agent::isTablet(),
				'desktop' => Agent::isDesktop(),
				'robot' => Agent::isRobot(),
				'languages' => Agent::languages(),
				'device' => Agent::device(),
				'platform' => [
					'name' => $platform,
					'version' => Agent::version($platform)
				],
				'browser' => [
					'name' => $browser,
					'version' => Agent::version($browser)
				],
				'ip' => $request->getClientIp()
			];

			$user = $request->user();
			if (!$user) {
				$user = User::firstOrCreate([
					'email' => $checkout['email-address'],
				]);

				$user->name = $checkout['first-name'].' '.$checkout['last-name'];

				if (!empty($checkout['create-account']) && $checkout['create-account'] == 'Y') {
					$password = HashIDs::encode(rand(5,2005));
					$user->password = Hash::make($password);

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
				}

				$user->save();
			}

			$order = Order::create([
				'checkout_json' => json_encode($checkout),
				'cart_json' => json_encode($items),
				'meta_json' => json_encode($meta),
				'user_id' => $user->id,
				'status_id' => 1
			]);

			Log::create([
				'user_id' => $user->id,
				'loggable_id' => $order->id,
				'loggable_type' => 'App\Order',
				'data' => 'Created Order #'.$order->id
			]);

			$this->send_order_email($order->id, $user->id);

			$hash = HashIDs::encode($order->id);

			if (env('APP_ENV') != 'development') {
				$request->session()->forget('cart');
				$request->session()->forget('checkout');
				$request->session()->forget('coupon');
			}

			if (!empty($request->input('token'))) {
				return redirect(url("order/$hash"));
			} else {
				return Response::json([
					'order_id' => $order->id,
					'hash' => $hash
				]);
			}
		}
	}

	public function postPayPal(Request $request) {
		foreach ($request->all() as $key => $value) {
			$request->session()->put("checkout.$key", $value);
		}

		$response = (new Client())->get(config('services.paypal.url'), [
			'verify' => false,
			'query' => [
				'USER' => config('services.paypal.user'),
				'PWD' => config('services.paypal.pwd'),
				'SIGNATURE' => config('services.paypal.signature'),
				'METHOD' => 'SetExpressCheckout',
				'VERSION' => 93,
				'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
				'PAYMENTREQUEST_0_AMT' => $request->total,
				'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
				'RETURNURL' => url('checkout/token'),
				'CANCELURL' => url('checkout')
			]
		]);

		parse_str($response->getBody(), $results);
		$results['REDIRECT_URL'] = config('services.paypal.redirect_url');

		return json_encode($results);
	}

	public function paypalToken(Request $request) {
		$request->session()->put('checkout.paypal-payerid', $request->input('PayerID'));
		$request->session()->put('checkout.paypal-token', $request->input('token'));

		if (env('APP_ENV') != 'development') {
			$response = (new Client())->get(config('services.paypal.url'), [
				'verify' => false,
				'query' => [
					'USER' => config('services.paypal.user'),
					'PWD' => config('services.paypal.pwd'),
					'SIGNATURE' => config('services.paypal.signature'),
					'METHOD' => 'DoExpressCheckoutPayment',
					'VERSION' => 93,
					'TOKEN' => $request->session('checkout.paypal-token'),
					'PAYERID' => $request->session('checkout.paypal-payerid'),
					'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
					'PAYMENTREQUEST_0_AMT' => $request->session('checkout.total'),
					'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
				]
			]);
		}

		return $this->postCheckout($request);
	}

	private static function buildItemsForView($items = []) {
		$cart = [
			'subtotal' => 0,
			'items' => []
		];

		if (is_array($items) && count($items)) {
			foreach ($items as $key => $item) {
				$attributes = [];

				if (!empty($item['product_id'])) {
					$product = Product::find($item['product_id']);
				}

				if (!empty($product->id)) {
					$price = ($product->sale_price > 0) ? $product->sale_price : $product->price;

					if (!empty($item['attributes'])) {
						foreach ($item['attributes'] as $akey => $aval) {
							$attr = Attribute::find($akey);
							if (!empty($attr->id)) {
								$attributes[] = [
									'attribute' => $attr,
									'value' => $aval
								];

								if ($attr->type == 'currency') {
									$price += $aval;
								}
							}
						}
					} else {
						$item['attributes'] = [];
					}

					$cart['items'][$key] = [
						'product' => $product,
						'quantity' => $item['quantity'],
						'attributes' => $attributes,
						'price' => $price
					];

					$cart['subtotal'] += ($price * $item['quantity']);
				}
			}
		}

		return $cart;
	}

	public function order($hash) {
		$id = HashIDs::decode($hash)[0];
		$order = Order::find($id);

		$checkout = (array) $order->checkout;

		if (!empty($order->id)) {
			return view('shop.order', [
				'title' => 'Order #'.$order->id,
				'order' => $order,
				'checkout' => $checkout,
				'cart' => (array) $order->cart,
				'meta' => (array) $order->meta,
				'billing_state' => Location::find($checkout['billing-state-id']),
				'billing_country' => Location::find($checkout['billing-country-id']),
				'shipping_state' => Location::find($checkout['shipping-state-id']),
				'shipping_country' => Location::find($checkout['shipping-country-id'])
			]);
		} else {
			return redirect();
		}
	}

	private function getProducts($slugs) {
		$products = Product::where('deleted_at', '=', null);
		if (!empty($slugs['category'])) {
			$category = Category::where('slug', '=', $slugs['category'])->first();

			if ($category) {
				if ($slugs['category'] != 'sale') {
					$products = Product::whereHas('categories', function($query) use ($category) {
						$query->where('categories.id', '=', $category->id);
					});
				} else {
					$products = Product::where('sale_price', '!=', '0');
				}
			} else {
				$products->where('id', '=', null);
			}
		}

		if (!empty($slugs['tag'])) {
			$tag = Tag::where('slug', '=', $slugs['tag'])->first();

			if ($tag) {
				$products->whereHas('tags', function($query) use ($tag) {
					$query->where('tags.id', '=', $tag->id);
				});
			} else {
				$products->where('id', '=', null);
			}
		}

		if (!empty($slugs['sort'])) {
			switch ($slugs['sort']) {
				case 'newest':
					$products->orderBy('created_at', 'DESC');
					break;
				case 'most-popular':
					$products->orderBy('total_sales_count', 'DESC');
					break;
				case 'alphabetical':
					$products->orderBy('name');
					break;
				case 'highest-contribution':
					$products->orderBy('contribution_amount', 'DESC');
					break;
				case 'default':
				default:
					break;
			}
		}

		if (!empty($slugs['search'])) {
			$products->where('name', 'LIKE', '%'.urldecode($slugs['search']).'%');
		}

		return $products->paginate(24);
	}

	public static function calculate_shipping() {
		$base_shipping = 0;
		$lightweight = 0; // (bracelets, stickers, etc) $2 for first item, $.50 for each additional
		$garments = 0; // $5.50 for first item, $1.50 each additional
		$hats = 0; // $7 for first item, $1.50 for each additional
		$hoodies = 0; // $8 for first item, $2.50 for each additional
		$lightweights = ['Bracelets'];

		foreach (session('cart') as $item) {
			$product = Product::find($item['product_id']);
			if ($product->name != 'Donate') {
				foreach ($product->categories as $category) {
					if($category->name == 'Hats') {
						if ($base_shipping < 7) {
							$base_shipping = 7;
						}
						$hats += $item['quantity'];
					} elseif($category->name == 'Garments') {
						if ($base_shipping < 5.5) {
							$base_shipping = 5.5;
						}
						$garments += $item['quantity'];
					} elseif($category->name == 'Sweats') {
						if ($base_shipping < 8) {
							$base_shipping = 8;
						}
						$hoodies += $item['quantity'];
					} elseif(in_array($category->name, $lightweights)) {
						if ($base_shipping < 2) {
							$base_shipping = 2;
						}
						$lightweight += $item['quantity'];
					}
				}
			}
		}

		$shipping = $base_shipping;

		if ($base_shipping == 2) {
			$lightweight--;
		} elseif ($base_shipping == 5.5) {
			$garments--;
		} elseif ($base_shipping == 7) {
			$hats--;
		} elseif ($base_shipping == 8) {
			$hoodies--;
		}

		for ($i = 0; $i < $lightweight; $i++) {
			$shipping += .5;
		}

		for ($i = 0; $i < $garments; $i++) {
			$shipping += 1.5;
		}

		for ($i = 0; $i < $hats; $i++) {
			$shipping += 1.5;
		}

		for ($i = 0; $i < $hoodies; $i++) {
			$shipping += 2.5;
		}

		return $shipping;
	}

	public static function calculate_discount() {
		$discount = 0;

		$coupon = \App\Coupon::where('code', '=', strtolower(session('coupon')))->first();

		if ($coupon) {
			$cart = self::buildItemsForView(session('cart'));
			switch ($coupon->type) {
				case 'shipping':
					if ($cart['subtotal'] >= $coupon->amount) {
						$discount = self::calculate_shipping();
					}
					break;
				case 'fixed':
					$discount = $coupon->amount;
					break;
				case 'percentage':
					$discount = number_format(($cart['subtotal'] * $coupon->amount), 2, '.', '');
					break;
			}
		}

		return $discount;
	}

	public static function calculate_total() {
		$cart = self::buildItemsForView(session('cart'));
		$total = $cart['subtotal'] + self::calculate_shipping() - self::calculate_discount() + session('checkout.gamerosity-donation');
		return $total;
	}

	public static function monthly_total() {
		$monthly_total = 0;

		$orders = \App\Order::where('created_at', 'LIKE', date('Y-m').'-%')->get();
		foreach ($orders as $order) {
			$monthly_total += $order->checkout->total;
		}

		return floor($monthly_total);
	}

	public static function send_order_email($order_id, $user_id) {
		$order = \App\Order::find($order_id);
		$user = \App\User::find($user_id);
		$checkout = (array) $order->checkout;

		//Mail::send('emails.order.create-html',
		Mail::queue(
			[
				'emails.order.create-html',
				'emails.order.create-text'
			],
			[
				'title' => 'Gamerosity Order #'.$order->id,
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
				$message->to($user->email)->subject('Your Gamerosity Order: #'.$order->id);
				$message->to('info@gamerosity.com')->subject('Your Gamerosity Order: #'.$order->id);
				$message->to('kevin@grizzdev.com')->subject('Your Gamerosity Order: #'.$order->id);
			}
		);
	}

}
