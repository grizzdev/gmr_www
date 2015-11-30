<?php
$state = \App\Location::find($nominee['state_id']);
?>
@extends('layouts.email')

@section('content')
<table cellspacing="2">
	<tr>
		<th align="right" valign="top">Name:</th>
		<td>{!! $nominee['name'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Birth Date:</th>
		<td>{!! date('m/d/Y', strtotime($nominee['birth_date'])) !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Email Address:</th>
		<td>{!! $nominee['email_address'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Phone Number:</th>
		<td>{!! $nominee['phone_number'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Gender:</th>
		<td>{!! ($nominee['gender'] == 'm') ? 'Male' : 'Female' !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Address:</th>
		<td>{!! $nominee['address'] !!}, {!! $nominee['city'] !!}, {!! $state->name !!} {!! $nominee['zip'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Shirt Size:</th>
		<td>{!! strtoupper($nominee['shirt_size']) !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Hospital:</th>
		<td>{!! $nominee['hospital_name'] !!}, {!! $nominee['hospital_location'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Cancer Type(s):</th>
		<td>{!! $nominee['cancer_type'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Nominee:</th>
		<td>{!! $user['name'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Relationship:</th>
		<td>{!! $nominee['relationship'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Facebook:</th>
		<td>{!! $nominee['facebook_url'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Twitter:</th>
		<td>{!! $nominee['twitter_url'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">YouTube:</th>
		<td>{!! $nominee['youtube_url'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Caring Bridge:</th>
		<td>{!! $nominee['caringbridge_url'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Overview:</th>
		<td><p>{!! nl2br($nominee['overview']) !!}</p></td>
	</tr>
</table>
@endsection
