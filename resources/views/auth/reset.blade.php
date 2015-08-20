<?php
$title = 'Reset Password';
?>
@extends('layouts.master')

@section('content')
{!! Form::open(['url' => 'password/reset', 'id' => 'resetForm', 'data-remote' => true, 'class' => 'pt-140']) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-sm-offset-4">
			<div class="form-group has-feedback">
				{!! Form::label('reset-email', 'Email Address', ['class' => 'control-label']) !!}
				<div class="input-group">
					{!! Form::email('email', old('email'), ['class' => 'form-control', 'required' => true, 'id' => 'reset-email']) !!}
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-sm-offset-4">
			<div class="form-group has-feedback">
				{!! Form::label('reset-password', 'Password', ['class' => 'control-label']) !!}
				<small>(Minimum 6 characters)</small>
				<div class="input-group">
					{!! Form::password('password', ['class' => 'form-control', 'required' => true, 'id' => 'reset-password', 'data-minlength' => 6]) !!}
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-sm-offset-4">
			<div class="form-group has-feedback">
				{!! Form::label('reset-password-confirm', 'Confirm Password', ['class' => 'control-label']) !!}
				<div class="input-group">
					{!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => true, 'id' => 'reset-password-confirm', 'data-minlength' => 6, 'data-match' => '#reset-password']) !!}
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 text-center">
			{!! Form::submit('Reset Password', ['class' => 'btn btn-danger']) !!}
		</div>
	</div>
	{!! Form::hidden('token', $token) !!}
{!! Form::close() !!}
@endsection
