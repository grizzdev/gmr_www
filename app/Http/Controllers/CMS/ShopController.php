<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Neworder;
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

	public function orderReport(Request $request) {
		if ($request->input('order_id')) {
			$orders = Neworder::where('id', '>=', $request->input('order_id'))->whereHas('cart.items', function($query) {
				$query->where('product_id', '!=', 1);
			})->where('status_id', '<', 3)->get();
		} else {
			$orders = Neworder::whereHas('cart.items', function($query) {
				$query->where('product_id', '!=', 1);
			})->where('status_id', '<', 3)->get();
		}

		return view('cms/temp/order_report', [
			'order_id' => $request->input('order_id'),
			'orders' => $orders
		]);
	}

}
