@extends('layouts.cms')

@section('content')
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
		</thead>
		<tbody>
			@foreach($orders as $order)
			<tr>
				<td><a href="{{ url('cms/shop/order/'.$order->id) }}">{{ $order->id }}</a></td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="" align="center">{!! $orders->render() !!}</td>
			</tr>
		</tfoot>
	</table>
</div>
@endsection
