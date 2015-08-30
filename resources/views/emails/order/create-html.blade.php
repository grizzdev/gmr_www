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
			{{ $order->billing_address->address_1 }}
			<br />
			@if(!empty($order->billing_address->address_2))
			{{ $order->billing_address->address_2 }}
			<br />
			@endif
			{{ $order->billing_address->city }}, {{ $order->billing_address->state->name }} {{ $order->billing_address->zip }}
			<br />
			{{ $order->billing_address->country->name }}
		</td>
		<td valign="top">
			{{ $order->shipping_address->address_1 }}
			<br />
			@if(!empty($order->shipping_address->address_2))
			{{ $order->shipping_address->address_2 }}
			<br />
			@endif
			{{ $order->shipping_address->city }}, {{ $order->shipping_address->state->name }} {{ $order->shipping_address->zip }}
			<br />
			{{ $order->shipping_address->country->name }}
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
			<b>Name:</b> {{ $order->user->name }}
			<br />
			@if(!empty($order->user->company))
			<b>Company:</b> {{ $order->user->company }}
			<br />
			@endif
			<b>Email:</b> {{ $order->user->email }}
			<br />
			<b>Phone:</b> {{ $order->user->phone }}
			<br />
			<b>Notes:</b> {!! nl2br($order->notes) !!}
		</td>
		<td valign="top">
			<b>Order Date:</b> {{ date('n/j/y g:ia', strtotime($order->created_at)) }}
			<br />
			<b>Order Status:</b> {{ $order->status->name }}
			<br />
			<b>Total Contribution:</b> ${{ $order->contribution() }}
			<br />
			<b>Payment Type:</b> {{ ($order->payment_method->slug == 'paypal') ? 'PayPal' : 'Credit Card' }}
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
					@foreach($order->cart->items as $item)
					<tr>
						<td>
							<b>{{ $item->product->name }}</b>
							@foreach($item->itemAttributes as $attribute)
								@if($attribute->attribute->name != 'Amount')
								<div>
									<b>{{ $attribute->attribute->name }}:</b>
									<?php
										switch ($attribute->attribute->type) {
											case 'text':
											case 'number':
												echo $attribute->value;
												break;
											case 'select':
												echo \App\Attribute::find($attribute->value)->name;
											case 'model':
												//if (!empty($attribute->attribute->model)) {
													//$modelname = "\\App\\{$attribute['attribute']->model}";
													//echo $modelname::find($attribute['value'])->name;
												//}
												break;
										}
									?>
								</div>
								@endif
							@endforeach
						</td>
						<td>${{ number_format($item->price(), 2, '.', '') }}</td>
						<td align="center">{{ $item->quantity }}</td>
						<td align="right">${{ number_format($item->price() * $item->quantity, 2, '.', '') }}</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th colspan="2" rowspan="{{ ($order->discount() > 0) ? 4 : 3 }}"></th>
						<th align="right">Subtotal</th>
						<td align="right">${{ number_format($order->subtotal(), 2, '.', '') }}
					</tr>
					<tr>
						<th align="right">Shipping</th>
						<td align="right">{{ ($order->shipping() > 0) ? '$'.number_format($order->shipping(), 2, '.', '') : 'FREE' }}</td>
					</tr>
					@if($order->discount() > 0)
					<tr>
						<th align="right">Discount</th>
						<td align="right">{{ '- $'.number_format($order->discount(), 2, '.', '') }}</td>
					</tr>
					@endif
					<tr>
						<th align="right">Total</th>
						<td align="right">${{ number_format($order->total(), 2, '.', '') }}</td>
					</tr>
				</tfoot>
			</table>
		</td>
	</tr>
</table>
@endsection
