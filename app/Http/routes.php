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

Route::get('', 'HomeController@home');
Route::get('robots.txt', 'HomeController@robots');
Route::get('humans.txt', 'HomeController@humans');
Route::get('crossdomain.xml', 'HomeController@crossdomain');
Route::post('upload/', 'HomeController@upload');

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
Route::get('shop/import', 'ShopController@import');
Route::get('shop/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}/{h?}/{i?}/{j?}', 'ShopController@shop');

Route::get('product/{sku}/{hero_slug?}', 'ShopController@product');

Route::get('cart', 'ShopController@cart');
Route::post('cart', 'ShopController@updateCart');
Route::delete('cart/{key}', 'ShopController@deleteCart');
Route::put('cart', 'ShopController@addCart');

Route::group(['middleware' => 'secure', 'prefix' => 'checkout'], function() {
	Route::get('/', 'ShopController@checkout');
	Route::post('/', 'ShopController@postCheckout');
	Route::post('/states', 'ShopController@states');
	Route::post('/paypal', 'ShopController@postPayPal');
	Route::get('/token', 'ShopController@paypalToken');
});

Route::get('order/{hash}', 'ShopController@order');
