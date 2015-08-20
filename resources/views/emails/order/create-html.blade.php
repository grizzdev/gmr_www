<?php
$checkout = (array)json_decode($order['checkout_json']);
$cart = (array)json_decode($order['cart_json']);
?>
@extends('layouts.email')

@section('content')
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="order-table">
	<tr>
		<td colspan="2">
			<h1>Thank you for your Order!</h1>
		</td>
	</tr>
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
			<b>Order Date:</b> {{ date('n/j/y g:ia', strtotime($order['created_at'])) }}
			<br />
			<b>Order Status:</b> {{ $status }}
			<br />
			<b>Total Contribution:</b> ${{ $contribution }}
			<br />
			<b>Payment Type:</b> {{ ($checkout['payment-type'] == 'paypal') ? 'PayPal' : 'Credit Card' }}
		</td>
	</tr>
	<tr>
		<td valign="top" colspan="2">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="items-table">
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
							<b>{{ $item->name }}</b>
						@foreach($item->attributes as $attr)
							@if($attr->name != 'Amount')
							<br />
							<small>
								<b>{{ $attr->name }}:</b>
								{{ $attr->value }}
							</small>
							@else
							<?php $item->price += $attr->value ?>
							@endif
						@endforeach
						</td>
						<td>${{ number_format($item->price, 2, '.', '') }}</td>
						<td align="center">{{ $item->quantity }}</td>
						<td align="right">${{ number_format($item->price * $item->quantity, 2, '.', '') }}</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th colspan="2" rowspan="{{ ($checkout['discount'] > 0) ? 4 : 3 }}"></th>
						<th align="right">Subtotal</th>
						<td align="right">${{ number_format($checkout['subtotal'] + $checkout['gamerosity-donation'], 2, '.', '') }}
					</tr>
					<tr>
						<th align="right">Shipping</th>
						<td align="right">{{ ($checkout['shipping'] > 0) ? '$'.number_format($checkout['shipping'], 2, '.', '') : 'FREE' }}</td>
					</tr>
					@if($checkout['discount'] > 0)
					<tr>
						<th align="right">Discount</th>
						<td align="right">{{ '- $'.number_format($checkout['discount'], 2, '.', '') }}</td>
					</tr>
					@endif
					<tr>
						<th align="right">Total</th>
						<td align="right">${{ (($checkout['total'] + $checkout['shipping'] - $checkout['discount'] + $checkout['gamerosity-donation']) < 0) ? '0.00' : number_format($checkout['subtotal'] + $checkout['shipping'] - $checkout['discount'] + $checkout['gamerosity-donation'], 2, '.', '') }}</td>
					</tr>
				</tfoot>
			</table>
		</td>
	</tr>
</table>
@endsection
