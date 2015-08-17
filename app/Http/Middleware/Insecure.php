<?php

namespace App\Http\Middleware;

use Closure;

class Insecure {

	public function handle($request, Closure $next) {
		if ($request->secure()) {
			$url = 'http://'.config('app.url').'/'.$request->path();
			return redirect(rtrim($url, '/'));
		}

		return $next($request);
	}

}
