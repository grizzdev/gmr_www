<?php

namespace App\Http\Middleware;

use Closure;
use App\Cart;

class Session {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $user_id = ($request->user()) ? $request->user()->id : null;

        if (empty($request->session()->get('cart_id'))) {
            $cart = Cart::create([
                'user_id' => $user_id
            ]);

            $request->session()->put('cart_id', $cart->id);
        }

        return $next($request);
    }

}
