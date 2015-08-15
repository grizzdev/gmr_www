<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\File;

class HomeController extends Controller {

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
