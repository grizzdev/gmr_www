@extends('layouts.basic')

@section('page')
	@include('includes.header')
	<div class="body-wrapper">
		<section class="container-fluid">
			@yield('content')
		</section>
		<div class="footer-push"></div>
	</div>
	@include('includes.footer')
	@include('includes.modal', [
		'id' => 'errorModal',
		'title' => 'Error!',
		'content' => '<p>There are errors in the form.</p><p>Please correct the fields marked with: <i class="glyphicon glyphicon-remove" style="color:#a94442"></i></p>',
		'view' => null,
		'buttons' => [
			'<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>'
		]
	])
	@if(!Auth::check())
	@include('includes.modal', [
		'id' => 'forgotModal',
		'title' => 'Forgot Password',
		'content' => null,
		'view' => 'includes/forgot-form',
		'buttons' => [
			'<button type="button" class="btn btn-danger">Reset Password</button>',
			'<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>'
		]
	])
	@endif
@endsection
