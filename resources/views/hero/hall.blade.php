@extends('layouts.master')

@section('content')
<div class="row heroes-content pt-100">
	<div class="col-sm-12 col-md-10 col-md-offset-1 pt-40 pb-40">
		<div class="row multi-columns-row">
			@foreach($heroes as $hero)
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 heroes-hero mb-50">
				@include('includes.hero', ['hero' => $hero])
			</div>
			@endforeach
		</div>
		<div class="row">
			<div class="col-xs-12 text-center">
				{!! $heroes->render() !!}
			</div>
		</div>
	</div>
</div>
@endsection
