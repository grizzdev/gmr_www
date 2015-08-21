<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller {

	public function contact() {
		return view('contact.contact', ['title' => 'Contact']);
	}

	public function postContact(Request $request) {
		Mail::queue(
			[
				'emails.contact-html',
				'emails.contact-text'
			],
			[
				'title' => 'New Contact Form Submission',
				'logo' => config('mail.view.logo'),
				'name' => $request->input('name'),
				'email' => $request->input('email'),
				'subject' => $request->input('subject'),
				'comments' => $request->input('message')
			],
			function ($message) {
				$message->to('info@gamerosity.com')->subject('Contact Form Submission');
			}
		);
	}

}
