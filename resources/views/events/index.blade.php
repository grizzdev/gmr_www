@extends('layouts.master')

@section('content')
<div class="row pt-100">
	@foreach($events as $event)
	<div class="col-xs-12">
		<div class="jumbotron">
			<h1>{{ $event->title }}</h1>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<h2>{{ date('l, F jS Y', strtotime($event->start_at)) }}</h2>
					<h2>{{ date('h:i A', strtotime($event->start_at)) }} - {{ date('h:i A', strtotime($event->end_at)) }}</h2>
				</div>
				<div class="col-sm-12 col-md-6">
					@if($event->venue)
					<h3>{{ $event->venue }}</h3>
					@endif
					@if($event->address)
					<h3>{{ $event->address }}</h3>
					@endif
					<h3>{{ $event->city }}, {{ $event->state->name }} {{ $event->zip }}</h3>
				</div>
			</div>
			<p>{!! nl2br($event->description) !!}</p>
			<p>Want to help out? <a href="{{ url('events/'.$event->slug) }}">Volunteer Here</a></p>
		</div>
	</div>
	@endforeach
</div>
@endsection
