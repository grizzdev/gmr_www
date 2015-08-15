@extends('layouts.basic')

@section('page')
	@include('includes.header')
	<section class="container-fluid">
		@yield('content')
	</section>
	@include('includes.footer')
@endsection
