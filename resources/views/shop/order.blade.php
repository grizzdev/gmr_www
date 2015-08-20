@extends('layouts.master')

@section('content')
	@include('includes.order', [
		'title' => 'Order #'.$order->id,
		'order' => $order,
		'checkout' => $checkout,
		'cart' => $cart,
		'meta' => $meta,
		'billing_state' => $billing_state,
		'billing_country' => $billing_country,
		'shipping_state' => $shipping_state,
		'shipping_country' => $shipping_country
	])
@endsection
