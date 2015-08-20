@extends('layouts.master')

@section('content')
<div class="account-content pt-100 pb-40">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
		{!!  !!}
		</div>
	</div>
	@include('includes.account-orders', [
		'user' => $user,
		'orders' => $orders,
		'paginate' => false
	])
</div>
@endsection
