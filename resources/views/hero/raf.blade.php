@extends('layouts.basic')

@section('page')
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Raised</th>
				<th>Funded?</th>
				<th>Active?</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($heroes as $hero)
			<form method="post" action="/heroes/raf" class="form-hero">
				<input type="hidden" name="id" value="{{ $hero->id }}" />
				<tr class="tr-{{ $hero->id }}">
					<td>{{ $hero->name }}</td>
					<td>${!! Form::number('raised', $hero->raised) !!}</td>
					<td>{!! Form::select('funded', [0 => 'No', 1 => 'Yes'], $hero->funded) !!}</td>
					<td>{!! Form::select('active', [0 => 'No', 1 => 'Yes'], $hero->active) !!}</td>
					<td>{!! Form::submit('save') !!}
				</tr>
			</form>
		@endforeach
		</tbody>
	</table>
@endsection
