@extends('layouts.master')

@section('content')
<div class="row checkout-form">
	<div class="col-sm-12 col-md-10 col-md-offset-1 pt-120 pb-40">
		{!! Form::open(['url' => 'checkout', 'id' => 'checkoutForm', 'data-remote' => true]) !!}
			<div class="row">
				<div class="col-xs-12 col-sm-6 billing-details"> <!-- billing -->
					<div class="row">
						<div class="col-xs-12">
							<h4>Billing Details</h4>
						</div>
					</div>
					<div class="row pb-15">
						<div class="col-xs-12">
							<div class="form-group has-feedback">
								{!! Form::label('billing-address-1', 'Address', ['class' => 'control-label']) !!}
								<div class="input-group">
									{!! Form::text('billing-address-1', session('checkout.billing-address-1'), ['class' => 'form-control', 'placeholder' => 'STREET ADDRESS', 'required' => true]) !!}
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>
							{!! Form::text('billing-address-2', session('checkout.billing-address-2'), ['class' => 'form-control', 'placeholder' => 'APARTMENT, SUITE, UNIT, ETC.', 'id' => 'billing-address-2']) !!}
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group has-feedback">
								{!! Form::label('billing-city', 'City', ['class' => 'control-label']) !!}
								<div class="input-group">
									{!! Form::text('billing-city', session('checkout.billing-city'), ['class' => 'form-control', 'required' => true]) !!}
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								{!! Form::label('billing-country-id', 'Country', ['class' => 'control-label']) !!}
								{!! Form::select('billing-country-id', $countries, (empty(session('checkout.billing-country-id')) ? 224 : session('checkout.billing-country-id')), ['class' => 'form-control', 'data-toggle' => 'state', 'data-target' => 'billing-state-id']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{!! Form::label('billing-state-id', 'State/Province', ['class' => 'control-label']) !!}
								<div id="billing-state-id-select">
									@include('includes.state-select', ['selected' => session('checkout.billing-state-id'), 'name' => 'billing-state-id', 'states' => $states, 'attributes' => ['class' => 'form-control']])
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group has-feedback">
								{!! Form::label('billing-zip', 'Postal Code', ['class' => 'control-label']) !!}
								<div class="input-group">
									{!! Form::text('billing-zip', session('checkout.billing-zip'), ['class' => 'form-control', 'required' => true]) !!}
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group has-feedback">
								{!! Form::label('first-name', 'First Name', ['class' => 'control-label']) !!}
								<div class="input-group">
									{!! Form::text('first-name', session('checkout.first-name'), ['class' => 'form-control', 'required' => true]) !!}
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group has-feedback">
								{!! Form::label('last-name', 'Last Name', ['class' => 'control-label']) !!}
								<div class="input-group">
									{!! Form::text('last-name', session('checkout.last-name'), ['class' => 'form-control', 'required' => true]) !!}
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								{!! Form::label('company-name', 'Company Name', ['class' => 'control-label']) !!}
								{!! Form::text('company-name', session('checkout.company-name'), ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group has-feedback">
								{!! Form::label('email-address', 'Email Address', ['class' => 'control-label']) !!}
								<div class="input-group">
									{!! Form::text('email-address', session('checkout.email-address'), ['class' => 'form-control', 'required' => true]) !!}
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group has-feedback">
								{!! Form::label('phone-number', 'Phone', ['class' => 'control-label']) !!}
								<div class="input-group">
									{!! Form::text('phone-number', session('checkout.phone-number'), ['class' => 'form-control', 'required' => true]) !!}
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>
						</div>
					</div>
					@if(!Auth::check())
					<!--
					<div class="row">
						<div class="col-xs-12">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('create-account', 'Y', false) !!}
									Create an account? <small class="glyphicon glyphicon-question-sign" title="Creating an account will allow you to track your orders, view and print invoices, etc." data-toggle="tooltip" data-placement="top"></small>
								</label>
							</div>
						</div>
					</div>
					-->
					@endif
				</div>
				<div class="col-xs-12 col-sm-6 shipping-details"><!-- shipping -->
					<div class="row">
						<div class="col-xs-6">
							<h4>Shipping Details</h4>
						</div>
						<div class="col-xs-6 text-right pt-8">
							<small><label>{!! Form::checkbox('same-as-billing', true, true, ['id' => 'same-as-billing']) !!} Use Billing Details</label></small>
						</div>
					</div>
					<div class="row pb-15">
						<div class="col-xs-12">
							<div class="form-group has-feedback">
								{!! Form::label('shipping-address-1', 'Address', ['class' => 'control-label']) !!}
								<div class="input-group">
									{!! Form::text('shipping-address-1', session('checkout.shipping-address-1'), ['class' => 'form-control', 'placeholder' => 'STREET ADDRESS', 'required' => true]) !!}
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>
							{!! Form::text('shipping-address-2', session('checkout.shipping-address-2'), ['class' => 'form-control', 'placeholder' => 'APARTMENT, SUITE, UNIT, ETC.', 'id' => 'shipping-address-2']) !!}
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group has-feedback">
								{!! Form::label('shipping-city', 'City', ['class' => 'control-label']) !!}
								<div class="input-group">
									{!! Form::text('shipping-city', session('checkout.shipping-city'), ['class' => 'form-control', 'required' => true]) !!}
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								{!! Form::label('shipping-country-id', 'Country', ['class' => 'control-label']) !!}
								{!! Form::select('shipping-country-id', $countries, (empty(session('checkout.shipping-country-id')) ? 224 : session('checkout.shipping-country-id')), ['class' => 'form-control', 'data-toggle' => 'state', 'data-target' => 'shipping-state-id']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{!! Form::label('shipping-state-id', 'State/Province', ['class' => 'control-label']) !!}
								<div id="shipping-state-id-select">
									@include('includes.state-select', ['selected' => session('checkout.shipping-state-id'), 'name' => 'shipping-state-id', 'states' => $states, 'attributes' => ['class' => 'form-control']])
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group has-feedback">
								{!! Form::label('shipping-zip', 'Postal Code', ['class' => 'control-label']) !!}
								<div class="input-group">
									{!! Form::text('shipping-zip', session('checkout.shipping-zip'), ['class' => 'form-control', 'required' => true]) !!}
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								{!! Form::label('notes', 'Order Notes', ['class' => 'control-label']) !!}
								{!! Form::textarea('notes', session('checkout.notes'), ['class' => 'form-control', 'rows' => 10]) !!}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<h4>Your Order</h4>
				</div>
				<div class="col-xs-12 table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th style="width:180px;text-align:right!important">Total</th>
							</tr>
						</thead>
						<tbody>
						@foreach($cart->items as $item)
							<tr>
								<td>
									<p>{!! $item->product->name !!}</p>
									<div>
										<b>Hero:</b> {{ $item->hero->name }}
									</div>
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
								<td>${!! number_format($item->price(), 2, '.', '') !!}</td>
								<td>{!! $item->quantity !!}</td>
								<td align="right">${!! number_format(($item->price() * $item->quantity), 2, '.', '') !!}</td>
							</tr>
						@endforeach
							<tr>
								<td colspan="3">
									<small>I would also like to donate directly to Gamerosity, to help with operational costs.</small>
								</td>
								<td>
									<div class="input-group">
										<div class="input-group-addon">$</div>
										{!! Form::number('gamerosity_donation', session('checkout.gamerosity_donation'), ['class' => 'form-control gamerosity-donation']) !!}
										<div class="input-group-addon">.00</div>
									</div>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th rowspan="{{ ($cart->discount() == 0) ? 3 : 4 }}" colspan="2"></th>
								<th>SUBTOTAL</th>
								<td align="right" class="cart-subtotal">${!! number_format($cart->subtotal() + session('checkout.gamerosity_donation'), 2, '.', '') !!}
							</tr>
							<tr>
								<th>SHIPPING</th>
								<td align="right" class="cart-shipping">{{ ($cart->shipping() > 0) ? '$'.number_format($cart->shipping(), 2, '.', '') : 'FREE' }}</td>
							</tr>
							@if($cart->discount() > 0)
							<tr>
								<th align="right">DISCOUNT</th>
								<td align="right" class="cart-discount">- ${{ number_format($cart->discount(), 2, '.', '') }}</td>
							</tr>
							@endif
							<tr>
								<th>TOTAL</th>
								<td align="right" class="cart-total">${{ number_format(($cart->subtotal() + session('checkout.gamerosity_donation') + $cart->shipping() - $cart->discount()), 2, '.', '') }}
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<h4>Payment</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<label>PayPal <img src="{{ asset('img/checkout/paypal.png') }}" alt="PayPal" />
						</div>
						<div class="panel-body">
							<p>You can pay with your PayPal account or Credit Card, via PayPal</p>
							<button class="btn btn-primary pay-pal-button">Pay with PayPal</button>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<label>Credit Card <img src="{{ asset('img/checkout/cards.png') }}" alt="Credit Cards" />
						</div>
						<div class="panel-body">
							<p>You can pay with your credit card if you don't have a PayPal account</p>
							<button class="btn btn-primary credit-card-button">Pay with Credit Card</button>
						</div>
					</div>
				</div>
			</div>
			{!! Form::hidden(null, config('services.stripe.key'), ['id' => 'stripe-pk']) !!}
			{!! Form::hidden('payment-type', null, ['id' => 'payment-type']) !!}
			{!! Form::hidden('payment-token', null, ['id' => 'payment-token']) !!}
			{!! Form::hidden('discount', number_format($cart->discount(), 2, '.', '')) !!}
			{!! Form::hidden('shipping', number_format($cart->shipping(), 2, '.', '')) !!}
			{!! Form::hidden('subtotal', number_format($cart->subtotal(), 2, '.', ''), ['id' => 'subtotal']) !!}
			{!! Form::hidden('total', number_format($cart->total(), 2, '.', ''), ['id' => 'total']) !!}
			{!! Form::hidden('_token', csrf_token()) !!}
		{!! Form::close() !!}
	</div>
</div>
@endsection
