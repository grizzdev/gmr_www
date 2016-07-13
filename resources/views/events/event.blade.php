@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row pt-100">
		<div class="col-xs-12">
			<h1>{{ $event->title }}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-6">
			<p>{{ date('l, F jS Y', strtotime($event->start_at)) }}</p>
			<p>{{ date('h:i A', strtotime($event->start_at)) }} - {{ date('h:i A', strtotime($event->end_at)) }}</p>
		</div>
		<div class="col-sm-12 col-md-6">
			@if($event->venue)
			<p>{{ $event->venue }}</p>
			@endif
			@if($event->address)
			<p>{{ $event->address }}</p>
			@endif
			<p>{{ $event->city }}, {{ $event->state->name }} {{ $event->zip }}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<p>{!! nl2br($event->description) !!}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<h3>Volunteer Opportunities</h3>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Job</th>
							<th>Description</th>
							<th>Date/Time</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($event->shifts()->whereNull('user_id')->get() as $shift)
						<tr>
							<td>{!! $shift->job->title !!}</td>
							<td>{!! $shift->job->description !!}</td>
							<td>{!! date('m/d/Y', strtotime($shift->start_at)) !!}<br />{!! date('g:i A', strtotime($shift->start_at)) !!}-{!! date('g:i A', strtotime($shift->end_at)) !!}</td>
							<td><a href="{{ url('events/'.$shift->event->slug.'/volunteer/'.$shift->id) }}">Volunteer Now!</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
