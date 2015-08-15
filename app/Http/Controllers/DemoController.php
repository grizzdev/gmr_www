<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DemoController extends Controller {

	public function home() {
		return view('demo.home');
	}

	public function about() {
		return view('demo.about');
	}

	public function contact() {
		return view('demo.contact');
	}

	public function faq() {
		return view('demo.faq');
	}

	public function shop() {
		return view('demo.shop');
	}

	public function product() {
		return view('demo.product');
	}

	public function team() {
		return view('demo.team');
	}

}
