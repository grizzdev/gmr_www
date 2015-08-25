<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Permission {

	public function handle($request, Closure $next) {
		if (!Auth::user()->hasRole(['admin', 'dru-zod'])) {
			return view('errors.401');
		}

		return $next($request);
	}

}
