<?php
$job = \App\EventJob::find($shift['event_job_id'])->toArray();
$event = \App\Event::find($job['event_id'])->toArray();
?>
@extends('layouts.email')

@section('content')
<table cellspacing="2">
	<tr>
		<th align="right" valign="top">Name:</th>
		<td>{!! $user['name'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Email Address:</th>
		<td>{!! $user['email'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Event:</th>
		<td>{!! $event['title'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Job:</th>
		<td>{!! $job['title'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Shift:</th>
		<td>{!! date('m/d/Y', strtotime($shift['start_at'])) !!} {!! date('g:i A', strtotime($shift['start_at'])) !!}-{!! date('g:i A', strtotime($shift['end_at'])) !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">T-shirt size:</th>
		<td>{!! $shirt_size !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Notes:</th>
		<td>{!! nl2br($notes) !!}</td>
	</tr>
</table>
@endsection
