@extends('layouts.master')

@section('content')
<div class="account-content pt-100 pb-40">
	@include('includes.account-orders', [
		'user' => $user,
		'orders' => $orders,
		'paginate' => true
	])
</div>
@endsection
