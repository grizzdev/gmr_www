@extends('layouts.email')

@section('content')
<table cellspacing="2" data-date="{!! time() !!}">
	<tr>
		<th align="right" valign="top">Name:</th>
		<td>{{ $name }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Email:</th>
		<td>{{ $email }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Subject:</th>
		<td>{{ $subject }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Message:</th>
		<td><p>{!! nl2br($comments) !!}</p></td>
	</tr>
</table>
@endsection
