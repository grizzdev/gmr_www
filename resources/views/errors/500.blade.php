<? $title = '500: Whoops!' ?>
@extends('layouts.master')

@section('content')
<div class="pt-150 pb-90 error-content full-width">
	<div class="row pt-100 pb-100">
		<div class="row text-center">
			<div class="col-xs-10 col-xs-offset-1 col-lg-6 col-lg-offset-3 error-text">
				<h1 class="pt-60 pb-25"></h1>
				<p class="pb-45">SOMETHING WENT WRONG</p>
				<a href="{{ url() }}" class="btn btn-default mb-50"><i class="fa fa-home"></i> BACK TO HOME PAGE</a>
			</div>
		</div>
	</div>
</div>
@endsection

