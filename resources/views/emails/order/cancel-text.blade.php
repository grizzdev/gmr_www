<?php
$checkout = (array)json_decode($order['checkout_json']);
$cart = (array)json_decode($order['cart_json']);
?>
Billing Details:
{{ $checkout['billing-address-1'] }}
@if(!empty($checkout['billing-address-2']))
{{ $checkout['billing-address-2'] }}
@endif
{{ $checkout['shipping-city'] }}, {{ $billing_state['name'] }} {{ $checkout['shipping-zip'] }}
{{ $billing_country['name'] }}

Shipping Details:
{{ $checkout['shipping-address-1'] }}
@if(!empty($checkout['shipping-address-2']))
{{ $checkout['shipping-address-2'] }}
@endif
{{ $checkout['shipping-city'] }}, {{ $shipping_state['name'] }} {{ $checkout['shipping-zip'] }}
{{ $shipping_country['name'] }}

Personal Details:
{{ $checkout['first-name'] }} {{ $checkout['last-name']}}
@if(!empty($checkout['company-name']))
{{ $checkout['company-name'] }}
@endif
{{ $checkout['email-address'] }}
{{ $checkout['phone-number'] }}
@if(!empty($checkout['notes']))
{!! nl2br($checkout['notes']) !!}
@endif

Order Details:
Date - {{ date('n/j/y g:ia', strtotime($order['created_at'])) }}
@if($order['updated_at'] != $order['created_at'])
Last Updated - {{ date('n/j/y g:ia', strtotime($order['updated_at'])) }}
@endif
Status - {{ $status }}
Contribution - ${{ $contribution }}
Payment Type - {{ ($checkout['payment-type'] == 'paypal') ? 'PayPal' : 'Credit Card' }}

Items:
@foreach($cart as $item)
	{{ $item->name }}
	@foreach($item->attributes as $attr)
		@if($attr->name != 'Amount')
	{{ $attr->name }}: {{ $attr->value }}
		@else
		<?php $item->price += $attr->value ?>
		@endif
	@endforeach
	Price: ${{ number_format($item->price, 2, '.', '') }}
	Qty: {{ $item->quantity }}
@endforeach

Subtotal: ${{ number_format($checkout['subtotal'] + $checkout['gamerosity-donation'], 2, '.', '') }}
Shipping: {{ ($checkout['shipping'] > 0) ? '$'.number_format($checkout['shipping'], 2, '.', '') : 'FREE' }}
@if($checkout['discount'] > 0)
Discount: {{ '- $'.number_format($checkout['discount'], 2, '.', '') }}
@endif
Total: ${{ (($checkout['subtotal'] + $checkout['shipping'] - $checkout['discount'] + $checkout['gamerosity-donation']) < 0) ? '0.00' : number_format($checkout['subtotal'] + $checkout['shipping'] - $checkout['discount'] + $checkout['gamerosity-donation'], 2, '.', '') }}
