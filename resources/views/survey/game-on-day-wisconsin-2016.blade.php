@extends('layouts.master')

@section('content')
<div class="row survey-form">
	<div class="col-sm-12 col-md-10 col-md-offset-1 pt-120 pb-40">
		{!! Form::open(['url' => 'survey/submit', 'data-remote' => true]) !!}
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="form-group has-feedback">
						{!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::text('name', null, ['class' => 'form-control', 'required' => true]) !!}
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="form-group has-feedback">
						{!! Form::label('email', 'Email Address', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::text('email', null, ['class' => 'form-control', 'required' => true]) !!}
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						{!! Form::label('What were the best parts of Game On Day that you think should definitely be replicated next year', 'What were the best parts of Game On Day that you think should definitely be replicated next year?', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::textarea('What were the best parts of Game On Day that you think should definitely be replicated next year', null, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						{!! Form::label('What would you like to see added in the future', 'What would you like to see added in the future?', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::textarea('What would you like to see added in the future', null, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						{!! Form::label('What do you think we should or could do without next year', 'What do you think we should or could do without next year?', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::textarea('What do you think we should or could do without next year', null, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						{!! Form::label('How would you define your role for Game On Day and would you like to change anything about the role you played', 'How would you define your role for Game On Day, and would you like to change anything about the role you played?', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::textarea('How would you define your role for Game On Day and would you like to change anything about the role you played', null, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						{!! Form::label('Do you have any tips or recommendations for next year', 'Do you have any tips or recommendations for next year?', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::textarea('Do you have any tips or recommendations for next year', null, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						{!! Form::label('Do you have any additional comments', 'Do you have any additional comments?', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::textarea('Do you have any additional comments', null, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 text-right">
					{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
			{!! Form::hidden('survey', 'Game On Day Wisconsin 2016') !!}
		{!! Form::close() !!}
	</div>
</div>
<div class="modal fade" id="surveyModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Thanks!</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-primary" data-dismiss="modal" value="Close" />
			</div>
		</div>
	</div>
</div>
@endsection
