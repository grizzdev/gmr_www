<?php
$old_checkout = $checkout;
$checkout = [];
foreach($old_checkout as $key => $val) {
	$checkout[$key] = $val;
}
$order = \App\Order::find($order['id']);
?>
@extends('layouts.email')

@section('content')
<h1>Thank you for your Order!</h1>
<table width="100%" style="table-layout:fixed" cellspacing="4">
	<tr>
		<td width="50%">
			<h2>Billing Details</h2>
		</td>
		<td width="50%">
			<h2>Shipping Details</h2>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<b>Address:</b>
			<br />
			{{ $checkout['billing-address-1'] }}
			<br />
			@if(!empty($checkout['billing-address-2']))
			{{ $checkout['billing-address-2'] }}
			<br />
			@endif
			{{ $checkout['shipping-city'] }}, {{ $billing_state['name'] }} {{ $checkout['shipping-zip'] }}
			<br />
			{{ $billing_country['name'] }}
		</td>
		<td valign="top">
			<b>Address:</b>
			<br />
			{{ $checkout['shipping-address-1'] }}
			<br />
			@if(!empty($checkout['shipping-address-2']))
			{{ $checkout['shipping-address-2'] }}
			<br />
			@endif
			{{ $checkout['shipping-city'] }}, {{ $shipping_state['name'] }} {{ $checkout['shipping-zip'] }}
			<br />
			{{ $shipping_country['name'] }}
		</td>
	</tr>
	<tr>
		<td>
			<h2>Personal Details</h2>
		</td>
		<td>
			<h2>Order Details</h2>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<b>Name:</b> {{ $checkout['first-name'] }} {{ $checkout['last-name']}}
			<br />
			@if(!empty($checkout['company-name']))
			<b>Company:</b> {{ $checkout['company-name'] }}
			<br />
			@endif
			<b>Email:</b> {{ $checkout['email-address'] }}
			<br />
			<b>Phone:</b> {{ $checkout['phone-number'] }}
			<br />
			<b>Notes:</b> {!! nl2br($checkout['notes']) !!}
		</td>
		<td valign="top">
			<b>Order Date:</b> {{ date('n/j/y g:ia', strtotime($order->created_at)) }}
			<br />
			<b>Order Status:</b> {{ $order->status->name }}
			<br />
			<b>Total Contribution:</b> ${{ $order->contribution() }}
			<br />
			<b>Payment Type:</b> {{ ($checkout['payment-type'] == 'paypal') ? 'PayPal' : 'Credit Card' }}
			<br />
			<table width="100%">
				<thead>
					<tr>
						<th>Item</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cart as $item)
					<tr>
						<td>
							<b>{{ $item['name'] }}</b>
							@foreach($item['attributes'] as $attr)
							<br />
							<small>
								<b>{{ $attr['name'] }}:</b>
								{{ $attr['value'] }}
							</small>
							@endforeach
						</td>
						<td>${{ number_format($item['price'], 2, '.', '') }}</td>
						<td align="center">{{ $item['quantity'] }}</td>
						<td align="right">${{ number_format($item['price'] * $item['quantity'], 2, '.', '') }}</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th colspan="2" rowspan="3"></th>
						<td align="right">Subtotal</td>
						<td align="right">${{ number_format($checkout['total'], 2, '.', '') }}
					</tr>
					<tr>
						<td align="right">Shipping</td>
						<td align="right">{{ ($checkout['shipping'] > 0) ? '$'.number_format($checkout['shipping'], 2, '.', '') : 'FREE' }}</td>
					</tr>
					@if($checkout['discount'] > 0)
					<tr>
						<td align="right">Discount</td>
						<td align="right">{{ '- $'.number_format($checkout['discount'], 2, '.', '') }}</td>
					</tr>
					@endif
					<tr>
						<td align="right">Total</td>
						<td align="right">${{ number_format($checkout['total'], 2, '.', '') }}</td>
					</tr>
				</tfoot>
			</table>
		</td>
	</tr>
</table>
@endsection
