<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\File;
use App\Category;
use App\Tag;
use App\Attribute;
use App\Location;
use App\Order;
use App\User;
use App\Coupon;
use App\Package;
use App\Hero;
use App\Status;
use App\Shop;
use App\Log;
use App\Cart;
use App\Item;
use App\ItemAttribute;
use App\Address;
use App\Neworder;
use App\PaymentMethod;
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
			'tags' => Tag::orderBy('order')->get(),
			'slugs' => $slugs,
			'cart' => Cart::find(session('cart_id'))
		]);
	}

	public function product($sku, $hero_slug = null) {
		$product = Product::where('sku', '=', $sku)->where('active', '=', 1)->first();

		if ($hero_slug) {
			session(['hero_slug' => $hero_slug]);
		}

		if (!empty($product->id)) {
			return view('shop.product', [
				'title' => $product->name,
				'product' => $product,
				'hero' => (!empty($hero_slug)) ? Hero::where('slug', '=', $hero_slug)->first() : null,
				'cart' => Cart::find(session('cart_id'))
			]);
		} else {
			return redirect('');
		}
	}

	public function cart(Request $request) {
		return view('shop.cart', [
			'title' => 'Cart',
			'cart' => Cart::find(session('cart_id'))
		]);
	}

	public function updateCart(Request $request) {
		$cart = Cart::find(session('cart_id'));

		if (!empty($request->input('coupon_code'))) {
			$coupon = Coupon::where('code', '=', strtolower($request->input('coupon_code')))->first();

			if ($coupon) {
				$cart->coupon_id = $coupon->id;
			} else {
				$cart->coupon_id = null;
			}

			$cart->save();
		}

		foreach ($request->input('items') as $id => $quantity) {
			$item = Item::find($id);

			if ($item) {
				if ($quantity) {
					$item->quantity = $quantity;
					$item->save();
				} else {
					$item->delete();
				}
			}
		}

		return Response::json([
			'view' => View::make('includes.cart', [
				'cart' => $cart
			])->render(),
			'count' => $cart->count()
		]);
	}

	public function deleteCart(Request $request, $id) {
		$cart = Cart::find(session('cart_id'));
		$item = Item::find($id);

		if ($item) {
			$item->delete();
		}

		return Response::json([
			'view' => View::make('includes.cart', [
				'cart' => $cart
			])->render(),
			'count' => $cart->count()
		]);
	}

	public function addCart(Request $request) {
		$cart = Cart::find(session('cart_id'));

		$cart->add($request->input('product_id'), $request->input('quantity'), $request->input('attributes')[39], $request->input('attributes'));

		$contribution = 0;
		$percentage = 0;
		if (session('hero_slug')) {
			$hero = Hero::where('slug', '=', session('hero_slug'))->first();
			if ($hero) {
				$contribution = $cart->contribution($hero->id);
				$percentage = floor((($hero->raised + $contribution) / $hero->goal) * 100);
			}
		}

		return Response::json([
			'count' => $cart->count(),
			'contribution' => $contribution,
			'percentage' => $percentage
		]);
	}

	public function checkout(Request $request) {
		$cart = Cart::find(session('cart_id'));
		$countries = [];
		$states = [];

		if ($cart->count() == 0) {
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
			'cart' => $cart,
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
		if ($request->input('payment-type') == 'paypal' && !empty($request->input('payment-token'))) {
		} else {
			$cart = Cart::find(session('cart_id'));

			$user = $request->user();
			if (!$user) {
				if ($request->input('email-address')) {
					$user = User::where('email', '=', $request->input('email-address'))->first();

					if (!$user) {
						$user = User::create([
							'email' => $request->input('email-address'),
							'name' => $request->input('first-name').' '.$request->input('last-name'),
							'company' => $request->input('company-name'),
							'phone' => $request->input('phone-number')
						]);
					}
				} elseif (session('checkout.email-address')) {
					$user = User::where('email', '=', session('checkout.email-address'))->first();

					if (!$user) {
						$user = User::create([
							'email' => session('checkout.email-address'),
							'name' => session('checkout.first-name').' '.session('checkout.last-name'),
							'company' => session('checkout.company-name'),
							'phone' => session('checkout.phone-number')
						]);
					}
				}
	
				$cart->user_id = $user->id;
				$cart->save();

				if (!empty($checkout['create-account']) && $checkout['create-account'] == 'Y') {
					$password = HashIDs::encode(rand(5,2005));
					$user->password = Hash::make($password);
					$user->save();
					$user->sendPasswordEmail();
				}
			}

			if ($request->input('billing-address-1')) {
				$billing_address = Address::create([
					'name' => null,
					'address_1' => $request->input('billing-address-1'),
					'address_2' => $request->input('billing-address-2'),
					'city' => $request->input('billing-city'),
					'state_id' => $request->input('billing-state-id'),
					'zip' => $request->input('billing-zip'),
					'country_id' => $request->input('billing-country-id'),
					'user_id' => $user->id,
					'is_billing' => 1,
					'is_shipping' => (!empty($request->input('same-as-billing'))) ? 1 : 0
				]);
			} elseif (session('checkout.billing-address-1')) {
				$billing_address = Address::create([
					'name' => null,
					'address_1' => session('checkout.billing-address-1'),
					'address_2' => session('checkout.billing-address-2'),
					'city' => session('checkout.billing-city'),
					'state_id' => session('checkout.billing-state-id'),
					'zip' => session('checkout.billing-zip'),
					'country_id' => session('checkout.billing-country-id'),
					'user_id' => $user->id,
					'is_billing' => 1,
					'is_shipping' => (!empty($request->input('same-as-billing'))) ? 1 : 0
				]);
			}

			if (empty($checkout['same-as-billing'])) {
				if ($request->input('shipping-address-1')) {
					$shipping_address = Address::create([
						'name' => null,
						'address_1' => $request->input('shipping-address-1'),
						'address_2' => $request->input('shipping-address-2'),
						'city' => $request->input('shipping-city'),
						'state_id' => $request->input('shipping-state-id'),
						'zip' => $request->input('shipping-zip'),
						'country_id' => $request->input('shipping-country-id'),
						'user_id' => $user->id,
						'is_billing' => 0,
						'is_shipping' => 1
					]);
				} elseif (session('checkout.shipping-address-1')) {
					$shipping_address = Address::create([
						'name' => null,
						'address_1' => session('checkout.shipping-address-1'),
						'address_2' => session('checkout.shipping-address-2'),
						'city' => session('checkout.shipping-city'),
						'state_id' => session('checkout.shipping-state-id'),
						'zip' => session('checkout.shipping-zip'),
						'country_id' => session('checkout.shipping-country-id'),
						'user_id' => $user->id,
						'is_billing' => 0,
						'is_shipping' => 1
					]);
				} else {
					$shipping_address = $billing_address;
				}
			} else {
				$shipping_address = $billing_address;
			}

			if (!empty($request->input('gamerosity_donation'))) {
				$item = Item::create([
					'product_id' => 1,
					'quantity' => 1,
					'hero_id' => 0,
					'cart_id' => $cart->id
				]);

				ItemAttribute::create([
					'item_id' => $item->id,
					'attribute_id' => 38,
					'value' => $request->input('gamerosity_donation')
				]);
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

			if ($request->input('payment-type') == 'stripe') {
				$payment_method = PaymentMethod::find(1);
				$token = $request->input('payment-token');
			} else {
				$payment_method = PaymentMethod::find(2);
				$token = $request->input('token');
			}

			$order = Neworder::create([
				'user_id' => $user->id,
				'cart_id' => $cart->id,
				'payment_method_id' => $payment_method->id,
				'payment_token' => $token,
				'status_id' => 1,
				'payment_status_id' => 1,
				'billing_address_id' => $billing_address->id,
				'shipping_address_id' => $shipping_address->id,
				'meta' => json_encode($meta),
				'notes' => $request->input('notes')
			]);

			if ($request->input('payment-type') != 'stripe') {
				$order->payer_id = session('checkout.paypal-payerid');
				$order->save();
			}

			foreach ($cart->items as $item) {
				if ($item->hero) {
					$item->hero->raised += $item->contribution();
					$item->hero->save();
				}
			}

			if (!empty($cart->coupon_id)) {
				$coupon = Coupon::find($cart->coupon_id);

				if (!empty($coupon->id)) {
					$coupon->used = ($coupon->used + 1);
					$coupon->save();
				}
			}

			Log::create([
				'user_id' => $user->id,
				'loggable_id' => $order->id,
				'loggable_type' => 'App\Neworder',
				'data' => 'Created Order #'.$order->id
			]);

			$order->sendEmail();

			$request->session()->forget('cart_id');

			if (!empty($request->input('token'))) {
				return redirect(url('order/'.$order->hash()));
			} else {
				return Response::json([
					'order_id' => $order->id,
					'hash' => $order->hash()
				]);
			}
		}
	}

	public function postPayPal(Request $request) {
		$request->session()->put('checkout.billing-address-1', $request->input('billing-address-1'));
		$request->session()->put('checkout.billing-address-2', $request->input('billing-address-2'));
		$request->session()->put('checkout.billing-city', $request->input('billing-city'));
		$request->session()->put('checkout.billing-state-id', $request->input('billing-state-id'));
		$request->session()->put('checkout.billing-zip', $request->input('billing-zip'));
		$request->session()->put('checkout.billing-country-id', $request->input('billing-country-id'));

		if (empty($checkout['same-as-billing'])) {
			$request->session()->put('checkout.shipping-address-1', $request->input('shipping-address-1'));
			$request->session()->put('checkout.shipping-address-2', $request->input('shipping-address-2'));
			$request->session()->put('checkout.shipping-city', $request->input('shipping-city'));
			$request->session()->put('checkout.shipping-state-id', $request->input('shipping-state-id'));
			$request->session()->put('checkout.shipping-zip', $request->input('shipping-zip'));
			$request->session()->put('checkout.shipping-country-id', $request->input('shipping-country-id'));
		} else {
			$request->session()->put('checkout.shipping-address-1', $request->input('billing-address-1'));
			$request->session()->put('checkout.shipping-address-2', $request->input('billing-address-2'));
			$request->session()->put('checkout.shipping-city', $request->input('billing-city'));
			$request->session()->put('checkout.shipping-state-id', $request->input('billing-state-id'));
			$request->session()->put('checkout.shipping-zip', $request->input('billing-zip'));
			$request->session()->put('checkout.shipping-country-id', $request->input('billing-country-id'));
		}

		$request->session()->put('checkout.first-name', $request->input('first-name'));
		$request->session()->put('checkout.last-name', $request->input('last-name'));
		$request->session()->put('checkout.company-name', $request->input('company-name'));
		$request->session()->put('checkout.email-address', $request->input('email-address'));
		$request->session()->put('checkout.phone-number', $request->input('phone-number'));

		$request->session()->put('checkout.notes', $request->input('notes'));
		$request->session()->put('checkout.gamerosity_donation', $request->input('gamerosity_donation'));
		$request->session()->put('checkout.payment-type', $request->input('payment-type'));
		$request->session()->put('checkout.payment-token', $request->input('payment-token'));
		$request->session()->put('checkout.discount', $request->input('discount'));
		$request->session()->put('checkout.shipping', $request->input('shipping'));
		$request->session()->put('checkout.subtotal', $request->input('subtotal'));
		$request->session()->put('checkout.total', $request->input('total'));

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

		/*if (env('APP_ENV') != 'development') {
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
		}*/

		return $this->postCheckout($request);
	}

	/*
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
	*/

	public function order($hash) {
		$id = HashIDs::decode($hash)[0];
		$order = Neworder::find($id);

		if (!empty($order->id)) {
			return view('shop.order', [
				'title' => 'Order #'.$order->id,
				'order' => $order,
			]);
		} else {
			return redirect();
		}
	}

	private function getProducts($slugs) {
		$products = Product::where('active', '=', 1);

		if (!empty($slugs['category'])) {
			$category = Category::where('slug', '=', $slugs['category'])->first();

			if ($category) {
				if ($slugs['category'] != 'sale') {
					$products = Product::whereHas('categories', function($query) use ($category) {
						$query->where('categories.id', '=', $category->id);
					});
				} else {
					$products = Product::where('products.sale_price', '!=', '0');
				}
			} else {
				$products->where('products.id', '=', null);
			}
		}

		if (!empty($slugs['tag'])) {
			$tag = Tag::where('slug', '=', $slugs['tag'])->first();

			if ($tag) {
				$products->whereHas('tags', function($query) use ($tag) {
					$query->where('tags.id', '=', $tag->id);
				});
			} else {
				$products->where('products.id', '=', null);
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
					$products->join('product_tag', 'products.id', '=', 'product_tag.product_id')->join('tags', 'tags.id', '=', 'product_tag.tag_id')->select('products.*', 'tags.order')->orderBy('order');
					break;
			}
		} else {
			$products->join('product_tag', 'products.id', '=', 'product_tag.product_id')->join('tags', 'tags.id', '=', 'product_tag.tag_id')->select('products.*', 'tags.order')->orderBy('order');
		}

		if (!empty($slugs['search'])) {
			$products->where('products.name', 'LIKE', '%'.urldecode($slugs['search']).'%');
		}

		return $products->paginate(24);
	}

	/*
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
	*/

	public static function monthly_total() {
		$monthly_total = 0;

		$orders = \App\Neworder::where('created_at', 'LIKE', date('Y-m').'-%')->get();
		foreach ($orders as $order) {
			$monthly_total += $order->total();
		}

		return floor($monthly_total);
	}

	public static function send_order_email($order_id, $user_id) {
		$order = \App\Order::find($order_id);
		$user = \App\User::find($user_id);
		$checkout = (array) $order->checkout;

		Mail::queue('emails.order.create-html', [
			'title' => 'Gamerosity Order #'.$order->id,
			'logo' => config('mail.view.logo'),
			'order' => $order,
			'billing_state' => Location::find($checkout['billing-state-id']),
			'billing_country' => Location::find($checkout['billing-country-id']),
			'shipping_state' => Location::find($checkout['shipping-state-id']),
			'shipping_country' => Location::find($checkout['shipping-country-id']),
			'status' => $order->status->name,
			'contribution' => $order->contribution()
		], function ($message) use ($user) {
			$message->to($user->email)->subject('Your Gamerosity Order');
			$message->bcc('info@gamerosity.com')->subject('Your Gamerosity Order');
			$message->bcc('kevin@grizzdev.com')->subject('Your Gamerosity Order');
		});
	}

}
