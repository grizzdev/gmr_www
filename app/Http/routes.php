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

Route::any('cms/order_report', 'CMS\ShopController@orderReport');
// http/s routes
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('test', 'HomeController@test');
Route::get('noms', 'HomeController@noms');
Route::get('cart', 'ShopController@cart');
Route::post('cart', 'ShopController@updateCart');
Route::delete('cart/{id}', 'ShopController@deleteCart');
Route::put('cart', 'ShopController@addCart');
Route::get('robots.txt', 'HomeController@robots');
Route::get('humans.txt', 'HomeController@humans');
Route::get('crossdomain.xml', 'HomeController@crossdomain');
Route::post('upload/', 'HomeController@upload');


// http-only routes
Route::group(['middleware' => 'insecure'], function() {
	Route::get('home', 'HomeController@home');
	Route::get('', 'HomeController@home');
	Route::get('newhome', 'HomeController@newhome');
	Route::get('game-on-a-super-story', 'HomeController@gameon');

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
	Route::group([
		'prefix' => 'events'
	], function() {
		Route::get('', 'EventController@index');
		Route::get('{slug}', 'EventController@event');
		Route::get('{slug}/volunteer/{shift_id}', 'EventController@volunteer');
		Route::post('{slug}/volunteer/{shift_id}', 'EventController@postVolunteer');
	});

	Route::group([
		'prefix' => 'survey'
	], function() {
		Route::get('game-on-day-wisconsin-2016', 'SurveyController@gameOnDayWisconsin2016');
		Route::post('submit', 'SurveyController@submit');
	});
});

// https-only routes
Route::group(['middleware' => 'secure'], function() {
	// routes requiring authenticated user
	Route::group(['middleware' => 'auth'], function() {
		Route::get('my-account', 'AccountController@index');
		Route::post('my-account', 'AccountController@save');
		Route::get('my-account/orders', 'AccountController@orders');
		Route::get('my-account/order/{id}', 'AccountController@order');
		Route::delete('my-account/order/{id}', 'AccountController@cancelOrder');
		Route::get('my-account/logs', 'AccountController@logs');

		Route::group([
			'prefix' => 'cms',
			'middleware' => 'permission',
			'namespace' => 'CMS'
		], function() {
			Route::get('', 'DashboardController@index');
			Route::get('dashboard', 'DashboardController@index');

			Route::group(['prefix' => 'shop'], function() {
				Route::get('', 'ShopController@index');
				Route::get('orders', 'ShopController@orders');
				Route::get('order/{id}', 'ShopController@order');
			});
		});
	});

	Route::get('checkout', 'ShopController@checkout');
	Route::post('checkout', 'ShopController@postCheckout');
	Route::post('checkout/states', 'ShopController@states');
	Route::post('checkout/paypal', 'ShopController@postPayPal');
	Route::get('checkout/token', 'ShopController@paypalToken');

	Route::get('order/{hash}', 'ShopController@order');
});
