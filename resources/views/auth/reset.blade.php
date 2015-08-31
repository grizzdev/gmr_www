<?php
$title = 'Reset Password';
?>
@extends('layouts.master')

@section('content')
<div class="row login-content pb-40">
	<div class="col-xs-12 col-sm-4 col-sm-offset-4">
		{!! Form::open(['url' => 'password/reset', 'id' => 'resetForm', 'data-remote' => true, 'class' => 'pt-140']) !!}
			<div class="form-group has-feedback">
				{!! Form::label('reset-email', 'Email Address', ['class' => 'control-label']) !!}
				<div class="input-group">
					{!! Form::email('email', old('email'), ['class' => 'form-control', 'required' => true, 'id' => 'reset-email']) !!}
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
			</div>
			<div class="form-group has-feedback">
				{!! Form::label('reset-password', 'Password', ['class' => 'control-label']) !!}
				<small>(Minimum 6 characters)</small>
				<div class="input-group">
					{!! Form::password('password', ['class' => 'form-control', 'required' => true, 'id' => 'reset-password', 'data-minlength' => 6]) !!}
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
			</div>
			<div class="form-group has-feedback">
				{!! Form::label('reset-password-confirm', 'Confirm Password', ['class' => 'control-label']) !!}
				<div class="input-group">
					{!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => true, 'id' => 'reset-password-confirm', 'data-minlength' => 6, 'data-match' => '#reset-password']) !!}
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
			</div>
			<div class="col-xs-12 text-center">
				{!! Form::submit('Reset Password', ['class' => 'btn btn-danger']) !!}
			</div>
			{!! Form::hidden('token', $token) !!}
		{!! Form::close() !!}
	</div>
</div>
@endsection
