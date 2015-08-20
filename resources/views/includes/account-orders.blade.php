<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Date</th>
				<th>Status</th>
				<th>Items</th>
				<th>Total</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $order)
			<tr>
				<td><a href="{{ url('my-account/order/'.$order->id) }}">{{ $order->id }}</a></td>
				<td>{{ date('n/j/y', strtotime($order->created_at)) }}</td>
				<td>{{ $order->status->name }}</td>
				<td>{{ count($order->cart) }}</td>
				<td align="right">${{ number_format($order->checkout->total, 2, '.', '') }}</td>
				<td align="right">
					@if(in_array($order->status->id, [1, 2, 4]))
					<a href="{{ url('my-account/order/'.$order->id) }}" data-remote="true" data-method="delete" data-confirm="Are you sure you want to cancel this order?" class="glyphicon glyphicon-remove btn-cancel-order" rel="nofollow" title="Cancel Order"></a>
					|
					@endif
					<a href="{{ url('my-account/order/'.$order->id) }}" class="fa fa-search btn-cancel-order" title="View Order"></a>
				</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<td colspan="6" align="center">
				@if($paginate)
				{!! $orders->render() !!}
				@else
				<a href="{{ url('my-account/orders') }}">View All Orders</a>
				@endif
			</td>
		</tfoot>
	</table>
</div>
