<?php

namespace App\Http\Middleware;

use Closure;

class Secure {

	public function handle($request, Closure $next) {
		if (env('APP_ENV') != 'development') {
			if (!$request->secure()) {
				return redirect(secure_url($request->path()));
			}
		}

		return $next($request);
	}

}
