<?php

namespace App\Http\Middleware;

use DB;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * The URIs that should be excluded from CSRF verification.
	 *
	 * @var array
	 */
	protected $except = [
		//
	];

	protected function tokensMatch($request) {
		$data = json_encode([
			'url' => $request->fullUrl(),
			'input' => $request->all(),
			'tokens' => [
				'header' => $request->header('X-CSRF-Token'),
				'session' => $request->session()->token(),
				'input' => $request->input('_token', null)
			],
			'ajax' => $request->ajax(),
			'secure' => $request->secure(),
			'ip' => $request->ip(),
			'query' => $request->query(),
			'headers' => $request->header()
		]);

		DB::table('requests')->insert([
			'payload_json' => $data,
			'created_at' => date('Y-m-d H:i:s')
		]);

		$token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');

		return $request->session()->token() == $token;
	}
}
