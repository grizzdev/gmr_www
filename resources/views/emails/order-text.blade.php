<?php
$old_checkout = $checkout;
$checkout = [];
foreach($old_checkout as $key => $val) {
	$checkout[$key] = $val;
}

$order = \App\Order::find($order['id']);
?>
Thank you for your Order!

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
{!! nl2br($checkout['notes']) !!}

Order Details:
Date - {{ date('n/j/y g:ia', strtotime($order->created_at)) }}
Status - {{ $order->status->name }}
Contribution - ${{ $order->contribution() }}
Payment Type - {{ ($checkout['payment-type'] == 'paypal') ? 'PayPal' : 'Credit Card' }}

Items:
@foreach($cart as $item)
	{{ $item['name'] }}
	@foreach($item['attributes'] as $attr)
	{{ $attr['name'] }}: {{ $attr['value'] }}
	@endforeach
	Price: ${{ number_format($item['price'], 2, '.', '') }}
	Qty: {{ $item['quantity'] }}
@endforeach

Subtotal: ${{ number_format($checkout['total'], 2, '.', '') }}
Shipping: FREE
Total: ${{ number_format($checkout['total'], 2, '.', '') }}
