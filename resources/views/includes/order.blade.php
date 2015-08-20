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
								{{ $checkout['billing-address-1'] }}
								<br />
								@if(!empty($checkout['billing-address-2']))
								{{ $checkout['billing-address-2'] }}
								<br />
								@endif
								{{ $checkout['shipping-city'] }}, {{ $billing_state->name }} {{ $checkout['shipping-zip'] }}
								<br />
								{{ $billing_country->name }}
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
								{{ $checkout['shipping-address-1'] }}
								<br />
								@if(!empty($checkout['shipping-address-2']))
								{{ $checkout['shipping-address-2'] }}
								<br />
								@endif
								{{ $checkout['shipping-city'] }}, {{ $shipping_state->name }} {{ $checkout['shipping-zip'] }}
								<br />
								{{ $shipping_country->name }}
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
								{{ $checkout['first-name'] }} {{ $checkout['last-name']}}
							</div>
						</div>
						@if(!empty($checkout['company-name']))
						<div class="row">
							<div class="col-xs-6">
								<b>Company:</b>
							</div>
							<div class="col-xs-6">
								{{ $checkout['company-name'] }}
							</div>
						</div>
						@endif
						<div class="row">
							<div class="col-xs-6">
								<b>Email:</b>
							</div>
							<div class="col-xs-6">
								{{ $checkout['email-address'] }}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<b>Phone:</b>
							</div>
							<div class="col-xs-6">
								{{ $checkout['phone-number'] }}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<b>Notes:</b>
							</div>
							<div class="col-xs-6">
								{!! nl2br($checkout['notes']) !!}
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
								${{ $order->contribution() }}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<b>Payment Type:</b>
							</div>
							<div class="col-xs-6">
								{{ ($checkout['payment-type'] == 'paypal') ? 'PayPal' : 'Credit Card' }}
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
										<td align="right">Subtotal</td>
										<td align="right">${{ number_format($checkout['subtotal'] + $checkout['gamerosity-donation'], 2, '.', '') }}
									</tr>
									<tr>
										<td align="right">Shipping</td>
										<td align="right">{{ (!empty($checkout['shipping'])) ? number_format($checkout['shipping'], 2, '.', '') : 'FREE' }}</td>
									</tr>
									@if($checkout['discount'] > 0)
									<tr>
										<td align="right">Discount</td>
										<td align="right">- ${{ number_format($checkout['discount'], 2, '.', '') }}</td>
									</tr>
									@endif
									<tr>
										<td align="right">Total</td>
										<td align="right">
											@if(0 > ($checkout['subtotal'] + $checkout['shipping'] - $checkout['discount'] + $checkout['gamerosity-donation']))
											$0.00
											@else
											${{ number_format($checkout['subtotal'] + $checkout['shipping'] - $checkout['discount'] + $checkout['gamerosity-donation'], 2, '.', '') }}
											@endif
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
