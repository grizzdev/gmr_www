@extends('layouts.email')

@section('content')
<table cellspacing="2">
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
		<td><pre>{{ $comments }}</pre></td>
	</tr>
</table>
@endsection
