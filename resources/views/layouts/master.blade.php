@extends('layouts.basic')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}" />
@endsection

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
			'<a type="button" class="btn btn-primary" data-dismiss="modal">OK</a>'
		]
	])
	@if(!Auth::check())
	@include('includes.modal', [
		'id' => 'forgotModal',
		'title' => 'Forgot Password',
		'content' => null,
		'view' => 'includes/forgot-form',
		'buttons' => [
			'<a href="#" class="btn btn-danger">Reset Password</a>',
			'<a href="#" class="btn btn-default" data-dismiss="modal">Cancel</a>'
		]
	])
	@endif
@endsection

@section('foot')
		<div id="fb-root"></div>
		<script src="https://checkout.stripe.com/checkout.js"></script>
		<script src="{{ elixir('js/all.js') }}"></script>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-50032356-5', 'auto');
			ga('send', 'pageview');
		</script>
@endsection
