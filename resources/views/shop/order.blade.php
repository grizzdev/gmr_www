@extends('layouts.master')

@section('content')
	@include('includes.order', [
		'title' => 'Order #'.$order->id,
		'order' => $order,
	])
@endsection
