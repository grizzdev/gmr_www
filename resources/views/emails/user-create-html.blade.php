@extends('layouts.email')

@section('content')
<p>Your Gamerosity account has been created!</p>
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
		<th align="right" valign="top">Password:</th>
		<td>{{ $password }}</td>
	</tr>
</table>
@endsection
