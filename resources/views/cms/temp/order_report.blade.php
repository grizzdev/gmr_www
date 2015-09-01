<style>
	hr {
		border: none;
		border-top: solid 1px #ddd;
	}

	table {
		width: 100%;
	}

	table > thead > tr > th,
	table > tbody > tr > td {
		border-bottom: solid 1px #ddd;
	}

	table > tbody > tr > td > table > thead > tr > th,
	table > tbody > tr > td > table > tbody > tr > td {
		border: none;
	}
</style>
{!! Form::open() !!}
	{!! Form::number('order_id', $order_id, ['placeholder' => 'Order ID']) !!}
	{!! Form::submit('Go') !!}
{!! Form::close() !!}
<hr />
<table>
	<thead>
		<tr>
			<th>Order #</th>
			<th>Customer</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($orders as $order)
		<tr>
			<td rowspan="2">{{ $order->id }}</td>
			<td rowspan="2">
				{{ $order->user->name }}<br />
				{{ $order->shipping_address->address_1 }}, {{ $order->shipping_address->address_2 }}<br />
				{{ $order->shipping_address->city }}, {{ $order->shipping_address->state->code }} {{ $order->shipping_address->zip }}<br />
				{{ $order->shipping_address->country->code }}
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%">
					<thead>
						<tr>
							<th>Item</th>
							<th>Size/Style</th>
							<th>Quantity</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($order->cart->items as $item)
						@if($item->product->name != 'Donate')
						<tr>
							<td>{{ $item->product->name }}</td>
							<td>
								@foreach($item->itemAttributes as $attribute)
								<b>{{ $attribute->attribute->name }}:</b>
								{{ \App\Attribute::find($attribute->value)->name }}
								<br />
								@endforeach
							</td>
							<td align="center">{{ $item->quantity }}</td>
						</tr>
						@endif
					@endforeach
					</tbody>
				</table>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
