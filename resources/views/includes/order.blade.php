<div class="hidden-print pt-120"></div>
<div class="row order-content">
	<div class="col-sm-12 col-md-10 col-md-offset-1 pb-40">
		<h1 class="hidden-print hidden-xs">Thank you for your Order!</h1>
		<h3 class="hidden-print visible-xs">Thank you for your Order!</h3>
		<p class="visible-print-block">Thank you for your Order!</p>
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h5>Billing Details</h5>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-6">
								<b>Address:</b>
							</div>
							<div class="col-xs-6">
								{{ $order->billing_address->address_1 }}
								<br />
								@if(!empty($order->billing_address->address_2))
								{{ $order->billing_address->address_2 }}
								<br />
								@endif
								{{ $order->billing_address->city }}, {{ $order->billing_address->state->name }} {{ $order->billing_address->zip }}
								<br />
								{{ $order->billing_address->country->name }}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h5>Shipping Details</h5>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-6">
								<b>Address:</b>
							</div>
							<div class="col-xs-6">
								{{ $order->shipping_address->address_1 }}
								<br />
								@if(!empty($order->shipping_address->address_2))
								{{ $order->shipping_address->address_2 }}
								<br />
								@endif
								{{ $order->shipping_address->city }}, {{ $order->shipping_address->state->name }} {{ $order->shipping_address->zip }}
								<br />
								{{ $order->shipping_address->country->name }}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h5>Personal Details</h5>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-6">
								<b>Name:</b>
							</div>
							<div class="col-xs-6">
								{{ $order->user->name }}
							</div>
						</div>
						@if(!empty($order->user->company))
						<div class="row">
							<div class="col-xs-6">
								<b>Company:</b>
							</div>
							<div class="col-xs-6">
								{{ $order->user->company }}
							</div>
						</div>
						@endif
						<div class="row">
							<div class="col-xs-6">
								<b>Email:</b>
							</div>
							<div class="col-xs-6">
								{{ $order->user->email }}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<b>Phone:</b>
							</div>
							<div class="col-xs-6">
								{{ $order->user->phone }}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<b>Notes:</b>
							</div>
							<div class="col-xs-6">
								{!! nl2br($order->notes) !!}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h5>Order Details</h5>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-6">
								<b>Order Number:</b>
							</div>
							<div class="col-xs-6">
							{{ $order->id }}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<b>Order Date:</b>
							</div>
							<div class="col-xs-6">
								{{ date('n/j/y g:ia', strtotime($order->created_at)) }}
							</div>
						</div>
						@if($order->updated_at != $order->created_at)
						<div class="row">
							<div class="col-xs-6">
								<b>Last Updated:</b>
							</div>
							<div class="col-xs-6">
								{{ date('n/j/y g:ia', strtotime($order->updated_at)) }}
							</div>
						</div>
						@endif
						<div class="row">
							<div class="col-xs-6">
								<b>Order Status:</b>
							</div>
							<div class="col-xs-6">
								{{ $order->status->name }}
								@if(Auth::check() && in_array($order->status->id, [1, 2, 4]))
								&nbsp;&nbsp;<a href="{{ url('my-account/order/'.$order->id) }}" data-remote="true" data-method="delete" data-confirm="Are you sure you want to cancel this order?" data-disable-with="Cancelling..." class="btn btn-xs btn-danger btn-cancel-order" rel="nofollow">Cancel Order</a>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<b>Total Contribution:</b>
							</div>
							<div class="col-xs-6">
								${{ number_format($order->contribution(), 2, '.', '') }}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<b>Payment Type:</b>
							</div>
							<div class="col-xs-6">
								{{ ($order->payment_method->slug == 'paypal') ? 'PayPal' : 'Credit Card' }}
							</div>
						</div>
						<br />
						<div class="table-responsive">
							<table class="table table-striped">
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
											@if($item->hero)
											<div>
												<b>Hero:</b> {{ $item->hero->name }}
											</div>
											@endif
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
										<td align="right">Subtotal</td>
										<td align="right">${{ number_format($order->subtotal(), 2, '.', '') }}
									</tr>
									<tr>
										<td align="right">Shipping</td>
										<td align="right">{{ (!empty($order->shipping())) ? number_format($order->shipping(), 2, '.', '') : 'FREE' }}</td>
									</tr>
									@if($order->discount() > 0)
									<tr>
										<td align="right">Discount</td>
										<td align="right">- ${{ number_format($order->discount(), 2, '.', '') }}</td>
									</tr>
									@endif
									<tr>
										<td align="right">Total</td>
										<td align="right">
											${{ number_format($order->total(), 2, '.', '') }}
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
