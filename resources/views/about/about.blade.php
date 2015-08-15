@extends('layouts.master')

@section('content')
<div class="about-header full-width pt-140 pb-140">
	<div class="row">
		<div class="col-xs-9 col-xs-offset-3 col-sm-6 col-sm-offset-6">
			<img src="{{ asset('img/about/about-text.png') }}" alt="It all started with a simple gesture, and we were never the same again." class="img-responsive wow fadeInRight" />
		</div>
	</div>
</div>
<div class="about-content text-center">
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1">
			<p>In December 2011, Manny and his family gave a young boy named Michael an XBox 360 as a way of “Giving Back.” Manny is a childhood cancer survivor. When he was 15, he was diagnosed with Stage 4 Large B Cell Non-Hodgkins Lymphoma. During that time he was given a Gameboy Color.</p>
			<p>Since that experience with Michael and his wonderful family, we’ve created a platform that empowers children with cancer by empowering a community to rally together in generosity and compassion. Using our model, we can raise awareness for those Little Heroes that can use a Sidekick!</p>
		</div>
	</div>
	<div class="row pb-30">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1">
			@include('includes.stats')
		</div>
	</div>
</div>
<div class="crowd-funded-content text-center full-width">
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1">
			<h3 class="banner">CROWD FUNDED COMPASSION</h3>
			<div class="row">
				<div class="col-sm-12 col-md-4 pt-20 pb-20 no-over">
					<img src="{{ asset('img/about/about-images-left.png') }}" class="img-responsive wow slideInLeft" />
				</div>
				<div class="col-sm-12 col-md-4 pt-20 pb-20 no-over">
					<img src="{{ asset('img/about/about-images-center.png') }}" class="img-responsive wow slideInUp" />
				</div>
				<div class="col-sm-12 col-md-4 pt-20 pb-20 no-over">
					<img src="{{ asset('img/about/about-images-right.png') }}" class="img-responsive wow slideInRight" />
				</div>
			</div>
			<div class="clear-50"></div>
			<p>You, your friends, and your network are more powerful than you think! Come together and raise support for kids with cancer. All approved children receive their very own Hero page. This page is meant to EMPOWER one another to generosity and advocacy through practical commerce and giving.</p>
			<p>Simply put: Buy stuff, help kids with cancer. Give, help kids with cancer. Share, help kids with cancer. You are more powerful than you think. When a Hero Campaign is funded, we send that particular child a Hero Package filled with incredible gifts that help them get through the roughest, most difficult time of their lives.</p>
		</div>
	</div>
</div>
@include('includes.ipad')
<div class="why-content full-width pt-70 pb-70 text-center">
	<div class="row">
		<div class="col-sm-12 col-md-10 col-md-offset-1">
			<div class="wow slideInDown">
				<h3 class="banner mb-30 mb-xs-10">WHY GAMEROSITY?</h3>
				<p>To put it simply, you can use whichever platform you’d like to support a child. We offer a very practical, very open, clean “engine” for advocacy. Simple share benefits, quality apparel, and active interaction with one another.</p>
				<p>We focus on the Little Heroes. This is for them. We know what it’s like to sit in that hospital bed for hours on end. Sure, there’s plenty of organizations out there, and we encourage you to support them as well. Gamerosity may not cure cancer, and that’s fine, our job is to be there for the Little Hero while they fight.</p>
			</div>
		</div>
	</div>
</div>

@endsection
