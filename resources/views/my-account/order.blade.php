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
	@if($order->logs->count())
	<div class="col-sm-12 col-md-10 col-md-offset-1 pb-40">
		<h3>Logs</h3>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Date</th>
						<th>User</th>
						<th>Log</th>
					</tr>
				</thead>
				<tbody>
					@foreach($order->logs as $log)
					<tr>
						<td>{{ date('n/j/y', strtotime($log->created_at)) }}</td>
						<td>{{ $log->user->name }}</td>
						<td>{{ $log->data }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif
@endsection
