<?php
$request['hero-state'] = \App\Location::find($request['hero-state-id']);
?>
@extends('layouts.email')

@section('content')
<table cellspacing="2">
	<tr>
		<th align="right" valign="top">Name:</th>
		<td>{!! $request['hero-name'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Birth Date:</th>
		<td>{!! $birth_date !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Gender:</th>
		<td>{!! ($request['hero-gender'] == 'm') ? 'Male' : 'Female' !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Address:</th>
		<td>{!! $request['hero-address'] !!}, {!! $request['hero-city'] !!}, {!! $request['hero-state']->name !!} {!! $request['hero-zip'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Shirt Size:</th>
		<td>{!! strtoupper($request['hero-shirt-size']) !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Hospital:</th>
		<td>{!! $request['hospital-name'] !!}, {!! $request['hospital-location'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Cancer Type(s):</th>
		<td>{!! $request['cancer'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Nominee:</th>
		<td>{!! $request['name'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Relationship:</th>
		<td>{!! $request['relationship'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Facebook:</th>
		<td>{!! $request['facebook-url'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Twitter:</th>
		<td>{!! $request['twitter-url'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">YouTube:</th>
		<td>{!! $request['youtube-url'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Caring Bridge:</th>
		<td>{!! $request['caringbridge-url'] !!}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Overview:</th>
		<td><p>{!! nl2br($request['overview']) !!}</p></td>
	</tr>
</table>
@endsection
