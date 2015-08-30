@extends('layouts.master')

@section('content')
<div class="heroes-header full-width pt-140">
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-5 col-md-offset-1 text-right pt-30">
			<img src="{{ asset('img/heroes/hero-header-text.png') }}" alt="The Gamerosity Hero Wall. Find a child to support. View their profile. Donate or Purchase Apparel. Watch the Meter Move." class="img-responsive wow fadeInLeft" />
		</div>
		<div class="col-xs-6 col-sm-6">
			<img src="{{ asset('img/heroes/hero-header-image.png') }}"  class="img-responsive wow fadeInUp" />
		</div>
	</div>
</div>
<div class="full-width">
	<div class="row pt-40 pb-20">
		<div class="col-xs-10 col-xs-offset-1">
			{!! Form::open(['url' => 'heroes/search', 'id' => 'heroesSearchForm']) !!}
				<div class="input-group">
					{!! Form::text('hero-search', null, ['class' => 'form-control input-lg', 'placeholder' => 'ENTER NAME, CANCER TYPE, OR HOSPITAL OF YOUR HERO']) !!}
					<span class="input-group-btn">
						<button type="submit" class="btn btn-default btn-lg pb-11"><i class="fa fa-search"></i></button>
					</span>
				</div>
				{!! Form::hidden('active', 1) !!}
				{!! Form::hidden('funded', 0) !!}
				{!! Form::token() !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>
@if(empty($page) || $page == 1)
<div class="heroes-longest full-width pt-20 pb-20">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
			<div class="row">
				<div class="col-xs-12">
					<h3 class="text-center">HEROES LONGEST ON CAMPAIGN</h3>
					<div class="row">
					@foreach($longest as $hero)
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 heroes-hero mb-50">
							@include('includes.hero', ['hero' => $hero])
						</div>
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="heroes-closest full-width pt-20 pb-20">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
			<div class="row">
				<div class="col-xs-12">
					<h3 class="text-center">HEROES CLOSEST TO FUNDED</h3>
					<div class="row">
					@foreach($closest as $hero)
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 heroes-hero mb-50">
							@include('includes.hero', ['hero' => $hero])
						</div>
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
<div class="full-width heroes-content">
	<div class="col-sm-12 col-md-12 col-lg-10 col-lg-offset-1 pt-20 pb-20">
		<div class="heroes-list">
			@include('includes.heroes', ['heroes' => $heroes, 'paginate' => true])
		</div>
	</div>
</div>
@endsection
