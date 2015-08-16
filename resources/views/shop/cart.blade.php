@extends('layouts.master')

@section('content')
<div class="cart-form pt-120 pb-40">
	<div class="row">
		<div class="col-sm-12 col-md-10 col-md-offset-1">
			<div id="cart-content">
				@include('includes.cart', ['cart' => $cart])
			</div>
		</div>
	</div>
</div>
<pre>{{ print_r(session('cart')) }}</pre>
@endsection
