@extends('layouts.master')

@section('content')
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
						<div class="row">
							<div class="col-xs-6">
								<b>Order Status:</b>
							</div>
							<div class="col-xs-6">
								{{ $order->status->name }}
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
						<div class="row table-responsive">
							<br />
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
										<th colspan="2" rowspan="3"></th>
										<td align="right">Subtotal</td>
										<td align="right">${{ $checkout['total'] }}
									</tr>
									<tr>
										<td align="right">Shipping</td>
										<td align="right">{{ (!empty($checkout['shipping'])) ? $checkout['shipping'] : 'FREE' }}</td>
									</tr>
									<tr>
										<td align="right">Total</td>
										<td align="right">${{ number_format($checkout['total'], 2, '.', '') }}</td>
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
@endsection
