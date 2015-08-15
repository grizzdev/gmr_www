@if(is_array($cart['items']) && count($cart['items']))
{!! Form::open(['url' => 'cart', 'id' => 'cartForm', 'data-remote' => true]) !!}
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th colspan="3">PRODUCT</th>
					<th>PRICE</th>
					<th style="width:100px">QUANTITY</th>
					<th>TOTAL</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cart['items'] as $key => $item)
				<tr>
					<td style="width:72px" align="center">
						<a href="{{ url('cart', $key) }}" data-method="delete" data-remote="true" rel="nofollow" class="item-remove"><i class="glyphicon glyphicon-remove"></i></a>
					</td>
					<td style="width:72px" align="center">
						@if(!empty($item['product']->files()->first()->id))
						<img src="{{ $item['product']->files()->first()->url() }}" alt="{{ $item['product']->name }}" class="img-thumbnail" />
						@endif
					</td>
					<td>
						<p><a href="{{ url('product/'.$item['product']->sku) }}">{{ $item['product']->name }}</a></p>
					@foreach ($item['attributes'] as $attribute)
						@if($attribute['attribute']->type != 'currency')
						<div>
							<b>{{ $attribute['attribute']->name }}:</b>
							<?php
							switch ($attribute['attribute']->type) {
								case 'text':
								case 'number':
									echo $attribute['value'];
									break;
								case 'select':
									echo \App\Attribute::find($attribute['value'])->name;
								case 'model':
									if (!empty($attribute['attribute']->model)) {
										$modelname = "\\App\\{$attribute['attribute']->model}";
										echo $modelname::find($attribute['value'])->name;
									}
									break;
							}
							?>
						</div>
						@endif
					@endforeach
					</td>
					<td align="center">
						${{ number_format($item['price'], 2, '.', '') }}
					</td>
					<td>
						{!! Form::number("cart[$key]", $item['quantity'], ['class' => 'form-control text-center']) !!}
					</td>
					<td align="center">
						${{ number_format(($item['price'] * $item['quantity']), 2, '.', '') }}
					</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2">
						{!! Form::text('coupon_code', null, ['class' => 'form-control', 'placeholder' => 'COUPON CODE', 'id' => 'coupon_code']) !!}
					</td>
					<td colspan="2">
						{!! Form::button('APPLY COUPON', ['class' => 'btn btn-primary btn-coupon']) !!}
					</td>
					<td colspan="2" align="right">
						{!! Form::submit('UPDATE CART', ['class' => 'btn btn-primary']) !!}
					</td>
				</tr>
				<tr>
					<td rowspan="{{ (\App\Http\Controllers\ShopController::calculate_discount() == 0) ? 3 : 4 }}" colspan="3" align="right">
						<h3 style="margin:0">Cart Totals</h3>
					</td>
					<th colspan="2" align="right">SUBTOTAL</th>
					<td align="right">${{ number_format($cart['subtotal'], 2, '.', '') }}
				</tr>
				<tr>
					<th colspan="2" align="right">SHIPPING</th>
					<td align="right">
						{{ (\App\Http\Controllers\ShopController::calculate_shipping() > 0) ? '$'.number_format(\App\Http\Controllers\ShopController::calculate_shipping(), 2, '.', '') : 'FREE' }}
					</td>
				</tr>
				@if(session('coupon') && \App\Http\Controllers\ShopController::calculate_discount() > 0)
				<tr>
					<th colspan="2" align="right">DISCOUNT</th>
					<td align="right">- ${{ number_format(\App\Http\Controllers\ShopController::calculate_discount(), 2, '.', '') }}</td>
				</tr>
				@endif
				<tr>
					<th colspan="2" align="right">TOTAL</th>
					<td align="right">${{ number_format(($cart['subtotal'] + \App\Http\Controllers\ShopController::calculate_shipping() - \App\Http\Controllers\ShopController::calculate_discount()), 2, '.', '') }}
				</tr>
			</tfoot>
		</table>
	</div>
{!! Form::close() !!}
<div class="text-right">
	<a href="{{ url('checkout') }}" class="btn btn-success">PROCEED TO CHECKOUT</a>
</div>
@else
<h2 class="text-center pt-30 pb-70">Your Cart is Empty</h2>
@endif
