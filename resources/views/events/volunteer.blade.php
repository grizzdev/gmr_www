@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row nominate-form pt-100 pb-40">
		<div class="col-xs-12 col-md-6 col-md-offset-3">
			{!! Form::open(['url' => 'events/'.$event->slug.'/volunteer/'.$shift->id, 'data-remote' => 'true', 'id' => 'volunteerForm', 'files' => true]) !!}
			<input type="hidden" name="event_id" value="{!! $event->id !!}" />
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="form-group has-feedback">
						{!! Form::label('name', 'Your Name', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::text('name', null, ['class' => 'form-control', 'required' => true]) !!}
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="form-group has-feedback">
						{!! Form::label('email', 'Your Email', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::text('email', null, ['class' => 'form-control', 'required' => true]) !!}
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group has-feedback">
						{!! Form::label('shift_id', 'Shift', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::select('shift_id', $shifts, $shift->id, ['class' => 'form-control', 'required' => true]) !!}
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group has-feedback">
						{!! Form::label('shirt_size', 'T-shirt size', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::select('shirt_size', ['Small' => 'Small', 'Medium' => 'Medium', 'Large' => 'Large', 'X-Large' => 'X-Large'], null, ['class' => 'form-control', 'required' => true]) !!}
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						{!! Form::label('notes', 'Notes', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row text-center pt-15">
				<div class="col-xs-12">
					{!! Form::submit('Volunteer!', ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
<div class="modal fade" id="volunteerModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Success!</h4>
			</div>
			<div class="modal-body">
				<p>Thanks for your help!<br />We'll review your submission, and respond soon.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection
