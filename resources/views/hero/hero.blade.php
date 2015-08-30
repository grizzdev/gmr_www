@extends('layouts.basic')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}" />
@endsection

@section('page')
	@include('includes.header')
	<section class="container-fluid">
		<div class="row hero-content-top pt-100">
			<div class="col-sm-12 col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="row">
							<div class="col-xs-12">
								@if($hero->file_id)
								<img src="{{ $hero->file->url() }}" alt="{{ $hero->name }}" class="img-responsive img-rounded" />
								@else
								<img src="{{ asset('uploads/2015/05/Profile-generic.jpg') }}" alt="{{ $hero->name }}" class="img-responsive img-rounded" />
								@endif
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 pt-5">
								<h1>
									@if(!empty($hero->facebook_url))
									<a href="{{ $hero->facebook_url }}"><i class="fa fa-facebook"></i></a>
									@endif
									@if(!empty($hero->twitter_url))
									<a href="{{ $hero->twitter_url }}"><i class="fa fa-twitter"></i></a>
									@endif
									@if(!empty($hero->youtube_url))
									<a href="{{ $hero->youtube_url }}"><i class="fa fa-youtube"></i></a>
									@endif
									@if(!empty($hero->caringbridge_url))
									<a href="{{ $hero->caringbridge_url }}"><i class="caring-bridge"></i></a>
									@endif
									| {{ $hero->name }}, {{ $hero->age() }}
								</h1>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 pt-10">
								<h4>{{ $hero->cancer_type }} | {{ $hero->hospital_name }}, {{ $hero->hospital_location }}</h4>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="row visible-md visible-lg">
							<div class="col-md-3">
								<a class="fb-share-button" data-href="{{ url('hero/'.$hero->slug) }}" data-layout="button_count"></a>
							</div>
							<div class="col-md-3">
								<a href="https://twitter.com/share" class="twitter-share-button" data-related="Gamerosity" data-hashtags="HeyCancerGameOn">Tweet</a>
							</div>
							<div class="col-md-6 pt-23"></div>
						</div>
						<div class="row">
							<div class="col-xs-12 pt-13">
								<div class="progress">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ $hero->percent() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $hero->percent() }}%;">
										<span>{{ $hero->percent() }}%</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 text-right">
								<span class="raised-of-goal">${{ $hero->raised() }} RAISED OF ${{ $hero->goal() }} GOAL</span>
							</div>
						</div>
						@if(!$hero->funded)
						<div class="row pt-10 text-center">
							<div class="col-xs-6">
								<h2>${{ (($hero->goal() - $hero->raised()) > 0) ? ($hero->goal() - $hero->raised()): 0 }}</h2>
								<h6>LEFT TO FUND</h6>
							</div>
							<div class="col-xs-6">
								<h2>{{ $hero->days_on_campaign() }}</h2>
								<h6>DAYS ON CAMPAIGN</h6>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<a href="{{ url('product/donate/'.$hero->slug) }}" class="btn btn-danger">DONATE TO THIS CAMPAIGN</a>
							</div>
						</div>
						@endif
					</div>
				</div>
				<div class="row pt-40 pb-40">
					<div class="col-xs-12">
						<h1>Overview</h1>
						<p>{!! nl2br($hero->overview) !!}</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	@if(!$hero->funded)
	@include('includes.hero-bar', ['hero' => $hero]);
	<section class="container-fluid">
		<div class="row hero-content-bottom">
			<div class="col-sm-12 col-md-10 col-md-offset-1 pt-40">
				<div class="row text-center products pb-40">
					<div class="col-xs-4">
						<a href="{{ url('shop/category/girls/hero/'.$hero->slug) }}"><img src="{{ asset('img/misc/shop_womens_365x439.jpg') }}" alt="Shop WOMENS" class="img-responsive" /></a>
					</div>
					<div class="col-xs-4">
						<a href="{{ url('shop/category/boys/hero/'.$hero->slug) }}"><img src="{{ asset('img/misc/shop_mens_365x439.jpg') }}" alt="Shop MENS" class="img-responsive" /></a>
					</div>
					<div class="col-xs-4">
						<a href="{{ url('shop/category/youth/hero/'.$hero->slug) }}"><img src="{{ asset('img/misc/shop_kids_365x439.jpg') }}" alt="Shop KIDS" class="img-responsive" /></a>
					</div>
				</div>
				<div class="row multi-columns-row shop-products pt-10">
					@include('includes.products', ['products' => \App\Product::popular(24), 'hero_slug' => $hero->slug]);
				</div>
			</div>
		</div>
	</section>
	@endif
	@include('includes.footer')
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
