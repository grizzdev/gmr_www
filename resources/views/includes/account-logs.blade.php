<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Date</th>
				<th>User</th>
				<th>Log</th>
			</tr>
		</thead>
		<tbody>
			@foreach($logs as $log)
			<tr>
				<td>{{ date('n/j/y', strtotime($log->created_at)) }}</td>
				<td>{{ $log->user->name }}</td>
				<td>{{ $log->data }}</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<td colspan="3" align="center">
				@if($paginate)
				{!! $logs->render() !!}
				@else
				<a href="{{ url('my-account/logs') }}">View All Logs</a>
				@endif
			</td>
		</tfoot>
	</table>
</div>
