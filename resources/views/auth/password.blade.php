<?php
$title = 'Reset Password';
?>
@extends('layouts.master')

@section('content')
	<div class="row login-content">
		<div class="col-xs-12 col-sm-4 col-sm-offset-4">
			@include('includes.forgot-form')
		</div>
	</div>
@endsection
