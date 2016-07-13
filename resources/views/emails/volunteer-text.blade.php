<?php
$job = \App\EventJob::find($shift['event_job_id'])->toArray();
$event = \App\Event::find($job['event_id'])->toArray();
?>
Name: {!! $user['name'] !!}
Email Address: {!! $user['email'] !!}
Event: {!! $event['title'] !!}
Job: {!! $job['title'] !!}
Shift: {!! date('m/d/Y', strtotime($shift['start_at'])) !!} {!! date('g:i A', strtotime($shift['start_at'])) !!}-{!! date('g:i A', strtotime($shift['end_at'])) !!}
Notes: {!! $notes !!}
