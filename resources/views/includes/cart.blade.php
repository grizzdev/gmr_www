@if($cart->count())
{!! Form::open(['url' => 'cart', 'id' => 'cartForm', 'data-remote' => true]) !!}
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th></th>
					<th class="hidden-xs"></th>
					<th>PRODUCT</th>
					<th>PRICE</th>
					<th style="width:100px">QUANTITY</th>
					<th>TOTAL</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cart->items as $item)
				<tr>
					<td style="width:72px" align="center">
						<a href="{{ url('cart', $item->id) }}" data-method="delete" data-remote="true" rel="nofollow" class="item-remove" data-toggle="tooltip" title="Remove Item from Cart"><i class="glyphicon glyphicon-remove"></i></a>
					</td>
					<td class="hidden-xs" style="width:72px" align="center">
						@if(!empty($item->product->files()->first()->id))
						<img src="{{ $item->product->files()->first()->url() }}" alt="{{ $item->product->name }}" class="img-thumbnail hidden-xs" />
						@endif
					</td>
					<td>
						<p><a href="{{ url('product/'.$item->product->sku) }}">{{ $item->product->name }}</a></p>
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
					<td align="center">
						@if($item->id != 1)
						${{ number_format($item->price(), 2, '.', '') }}
						@endif
					</td>
					<td>
						@if($item->id != 1)
						{!! Form::number("items[$item->id]", $item->quantity, ['class' => 'form-control text-center']) !!}
						@endif
					</td>
					<td align="center">
						${{ number_format(($item->price() * $item->quantity), 2, '.', '') }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<table class="table">
			<tfoot>
				<tr>
					<td colspan="3">
						<div class="row">
							<div class="col-xs-5 col-sm-2">
								{!! Form::text('coupon_code', null, ['class' => 'form-control', 'placeholder' => 'COUPON CODE', 'id' => 'coupon_code', 'style' => 'max-width:144px']) !!}
							</div>
							<div class="col-xs-7 col-sm-10">
								{!! Form::button('APPLY COUPON', ['class' => 'btn btn-sm btn-primary btn-coupon', 'data-disable-with' => 'APPLYING...']) !!}
							</div>
						</div>
					</td>
					<td align="right">
						{!! Form::submit('UPDATE CART', ['class' => 'btn btn-sm btn-primary', 'data-disable-with' => 'UPDATING...']) !!}
					</td>
				</tr>
				<tr>
					<td rowspan="{{ ($cart->discount() > 0) ? 4 : 3 }}" width="50%"></td>
					<td rowspan="{{ ($cart->discount() > 0) ? 4 : 3 }}" align="right">
						<h3 style="margin:0">Cart Totals</h3>
					</td>
					<th align="right">SUBTOTAL</th>
					<td align="right">${{ number_format($cart->subtotal(), 2, '.', '') }}
				</tr>
				<tr>
					<th align="right">SHIPPING</th>
					<td align="right">
						{{ ($cart->shipping()) ? '$'.number_format($cart->shipping(), 2, '.', '') : 'FREE' }}
					</td>
				</tr>
				@if($cart->discount())
				<tr>
					<th align="right">DISCOUNT</th>
					<td align="right">- ${{ number_format($cart->discount(), 2, '.', '') }}</td>
				</tr>
				@endif
				<tr>
					<th align="right">TOTAL</th>
					<td align="right">${{ number_format($cart->total(), 2, '.', '') }}
				</tr>
			</tfoot>
		</table>
	</div>
	{!! Form::hidden('_token', csrf_token()) !!}
{!! Form::close() !!}
<div class="text-right">
	<a href="{{ url('checkout') }}" class="btn btn-danger">PROCEED TO CHECKOUT</a>
</div>
@else
<h2 class="text-center pt-30 pb-70">Your Cart is Empty</h2>
@endif
