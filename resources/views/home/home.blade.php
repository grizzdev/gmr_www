@extends('layouts.master')

@section('content')
<div class="home-section-top full-width pt-100">
	<div class="row vcenter">
		<div class="col col-xs-5 col-xs-offset-1">
			<img src="{{ asset('img/home/copy-001.png') }}" alt="GAMEROSITY" class="img-responsive wow fadeInDownBig" data-wow-delay="1s" />
			<img src="{{ asset('img/home/copy-002.png') }}" alt="Empowering a community to" class="img-responsive wow fadeInUpBig" data-wow-delay="1.5s" />
			<img src="{{ asset('img/home/copy-003.png') }}" alt="Empower children with cancer" class="img-responsive wow fadeInDownBig" data-wow-delay="2s" />
			<a href="{{ url('heroes') }}"><img src="{{ asset('img/home/slider-button.png') }}" alt="Support a Child" class="img-responsive wow fadeInDownBig" data-wow-delay="2.5s" /></a>
			<a href="#video"><img src="{{ asset('img/home/slider-watch.png') }}" alt="Watch the video" class="img-responsive wow fadeInDownBig" data-wow-delay="3s" /></a>
		</div>
		<div class="col col-xs-6">
			<img src="{{ asset('img/home/lauranne.png') }}" alt="Lauranne" class="img-responsive wow bounceInRight img-section-1-hero" data-wow-delay="0.5s" />
		</div>
	</div>
</div>
<div class="home-section-stats full-width pt-70 pb-70">
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-1">
			<div class="wow fadeInRightBig">
				<p>Gamerosity believes in community driven generosity and compassion. &nbsp;All of our Hero Packages are funded primarily&nbsp;through donations and apparel purchases. &nbsp;We are a volunteer-ran group of people who give our time and passion to fulfilling these packages and orders for people all over the country!</p>
				<p>We believe We Are the Difference Makers</p>
			</div>
		</div>
		<div class="col-xs-12 col-sm-8 col-md-6">
			@include('includes.stats')
		</div>
	</div>
</div>
<div class="home-section-featured full-width pt-70 pb-50">
	<div class="wow fadeInDownBig row">
		<h2 class="text-center">FEATURED CAMPAIGNS</h2>
		<div class="col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
			<div class="row">
				<div class="col-xs-12 col-sm-6 pb-20">
					<h4 class="text-center">LONGEST ON CAMPAIGN</h4>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="heroes-hero">
								@include('includes.hero', ['hero' => \App\Hero::longest(1)])
							</div>
						</div>
						<div class="hidden-xs hidden-sm col-md-6">
							<div class="heroes-hero">
								@include('includes.hero', ['hero' => \App\Hero::longest(1, 1)])
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 pb-20">
					<h4 class="text-center">CLOSEST TO FUNDED</h4>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="heroes-hero">
								@include('includes.hero', ['hero' => \App\Hero::closest(1, 0)])
							</div>
						</div>
						<div class="hidden-xs hidden-sm col-md-6">
							<div class="heroes-hero">
								@include('includes.hero', ['hero' => \App\Hero::closest(1, 1)])
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="home-section-crowd-funded full-width pt-70 pb-70">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-1 pb-20">
			<h3 class="wow fadeInDownBig">CROWD-FUNDED COMPASSION</h3>
			<p class="wow fadeInDownBig"><strong>You, your friends, and your network are more powerful than you think!</strong>&nbsp;Come together and raise support for kids with cancer. All approved children receive their very own Hero page. This page is meant to&nbsp;<strong>EMPOWER</strong>&nbsp;one another to generosity and advocacy through practical commerce and giving.</p>
			<a class="wow fadeInDownBig" href="{{ url('shop') }}">Shop the Gamerosity Store &gt;</a>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-7 text-center">
			<img src="{{ asset('img/home/home-computer2.png') }}" class="img-responsive wow fadeInUpBig" />
		</div>
	</div>
</div>
<!--
<div class="home-section-package full-width">
	hero package
</div>
-->
<div class="home-section-ipad full-width text-center">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
			<img src="{{ asset('img/misc/iPad.png') }}" class="img-responsive wow fadeInDownBig" />
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 pb-30">
			<p class="wow fadeInUpBig"><strong>Some control during some uncontrollable circumstances.</strong> Childhood Cancer takes so much away from children. What we give back is a tangible symbol of compassion that helps them through the toughest time of their lives. Music, movies, games, camera, education are right at their fingertips.</p>
		</div>
	</div>
</div>
<div class="home-section-video full-width" id="video">
	<iframe src="http://player.vimeo.com/video/58801763?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" allowfullscreen="" id="fitvid542864"></iframe>
</div>
<div class="home-section-shop full-width">
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-1">
			<img src="{{ asset('img/home/grid-shop-2.png') }}" alt="BUY APPAREL, HELP KIDS WITH CANCER." class="img-responsive" />
		</div>
	</div>
</div>
<!--
<div class="home-section-9 full-width">
	newsletter
</div>
-->
@endsection
