<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// http/s routes
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);
Route::get('cart', 'ShopController@cart');
Route::post('cart', 'ShopController@updateCart');
Route::delete('cart/{key}', 'ShopController@deleteCart');
Route::put('cart', 'ShopController@addCart');
Route::get('robots.txt', 'HomeController@robots');
Route::get('humans.txt', 'HomeController@humans');
Route::get('crossdomain.xml', 'HomeController@crossdomain');
Route::post('upload/', 'HomeController@upload');

// http-only routes
Route::group(['middleware' => 'insecure'], function() {
	Route::get('home', 'HomeController@home');
	Route::get('', 'HomeController@home');

	Route::get('about', 'AboutController@about');
	Route::get('team', 'TeamController@team');
	Route::get('faq', 'FAQController@faq');

	Route::get('contact', 'ContactController@contact');
	Route::post('contact', 'ContactController@postContact');

	Route::get('heroes', 'HeroController@heroes');
	Route::post('heroes/search', 'HeroController@search');
	Route::get('heroes/raf', 'HeroController@raf');
	Route::post('heroes/raf', 'HeroController@raf_post');
	Route::get('hero/{slug}', 'HeroController@hero');
	Route::get('hall-of-heroes', 'HeroController@hall');
	Route::get('nominate-a-hero', 'HeroController@nominate');
	Route::post('nominate-a-hero', 'HeroController@postNominate');

	Route::get('shop', 'ShopController@shop');
	Route::get('shop/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}/{h?}/{i?}/{j?}', 'ShopController@shop');

	Route::get('product/{sku}/{hero_slug?}', 'ShopController@product');
});

Route::group(['middleware' => 'secure'], function() {
	Route::get('my-account', 'AccountController@index');
	Route::get('my-account/orders', 'AccountController@orders');
	Route::get('my-account/order/{id}', 'AccountController@order');
	Route::delete('my-account/order/{id}', 'AccountController@cancelOrder');
	Route::get('checkout', 'ShopController@checkout');
	Route::post('checkout', 'ShopController@postCheckout');
	Route::post('checkout/states', 'ShopController@states');
	Route::post('checkout/paypal', 'ShopController@postPayPal');
	Route::get('checkout/token', 'ShopController@paypalToken');

	Route::get('order/{hash}', 'ShopController@order');
});
