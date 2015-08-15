<?php

$birth_date = date('m/d/Y', strtotime($request->input('hero-dob-month').'/'.$request->input('hero-dob-day').'/'.$request->input('hero-dob-year')));

?>
@extends('layouts.email')

@section('content')
<table cellspacing="2">
	<tr>
		<th align="right" valign="top">Name:</th>
		<td>{{ $request->input('hero-name') }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Birth Date:</th>
		<td>{{ $birth_date }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Address:</th>
		<td>{{ $request->input('hero-address') }}, {{ $request->input('hero-city') }}, {{ $request->input('hero-state') }} {{ $request->input('hero-zip') }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Shirt Size:</th>
		<td>{{ strtoupper($request->input('hero-shirt-size')) }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Hospital:</th>
		<td>{{ $request->input('hospital-name') }}, {{ $request->input('hospital-location') }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Cancer Type(s):</th>
		<td>{{ $request->input('cancer') }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Nominee:</th>
		<td><a href="mailto:{{ $request->input('email') }}">{{ $request->input('name') }}</a></td>
	</tr>
	<tr>
		<th align="right" valign="top">Relationship:</th>
		<td>{{ $request->input('relationship') }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Facebook:</th>
		<td>{{ $request->input('facebook-url') }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Twitter:</th>
		<td>{{ $request->input('twitter-url') }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">YouTube:</th>
		<td>{{ $request->input('youtube-url') }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Caring Bridge:</th>
		<td>{{ $request->input('caringbridge-url') }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Overview:</th>
		<td><pre>{{ $request->input('overview') }}</pre></td>
	</tr>
	@if(!empty($request->input('sidekick-name')) && !empty($request->input('sidekick-email')))
	<tr>
		<th align="right" valign="top">Sidekick:</th>
		<td><a href="mailto:{{ $request->input('sidekick-email') }}">{{ $request->input('sidekick-name') }}</a></td>
	</tr>
	@endif
</table>
@endsection
