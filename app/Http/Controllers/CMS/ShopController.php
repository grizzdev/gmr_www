<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Attribute;
use App\Category;
use App\Tag;

class ShopController extends Controller {

	public function index() {
		return view('cms.shop.index', [
			'title' => 'Shop'
		]);
	}

	public function orders() {
		return view('cms.shop.orders', [
			'title' => 'Orders',
			'orders' => Order::orderBy('created_at', 'desc')->paginate(20)
		]);
	}

	public function order($id) {
		$order = Order::find($id);

		return view('cms.shop.order', [
			'title' => 'Order #'.$order->id,
			'order' => $order
		]);
	}

}
