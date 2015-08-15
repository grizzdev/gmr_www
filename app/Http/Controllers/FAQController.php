<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class FAQController extends Controller {

	public function faq() {
		return view('faq.faq', ['title' => 'FAQ']);
	}
}
