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
@endsection
