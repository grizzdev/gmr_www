@extends('layouts.email')

@section('content')
<table cellspacing="2">
	<tr>
		<th align="right" valign="top">Name:</th>
		<td>{{ $survey_data['name'] }}</td>
	</tr>
	<tr>
		<th align="right" valign="top">Email:</th>
		<td>{{ $survey_data['email'] }}</td>
	</tr>
@foreach($survey_data as $q => $a)
	@if(!in_array($q, ['name', 'email', 'survey', '_token', 'token']))
	<tr>
		<th colspan="2">{!! preg_replace('/_/', ' ', $q) !!}?</th>
	</tr>
	<tr>
		<td colspan="2"><p>{!! nl2br($a) !!}</p></td>
	</tr>
	@endif
@endforeach
	</tr>
</table>
@endsection
