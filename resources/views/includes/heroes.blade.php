@if(!empty($heroes) && $heroes->count())
	<div class="row multi-columns-row">
		@foreach($heroes as $hero)
		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 heroes-hero mb-50">
			@include('includes.hero', ['hero' => $hero])
		</div>
		@endforeach
	</div>
	@if(!empty($paginate))
	<div class="row">
		<div class="col-xs-12 text-center">
			{!! $heroes->render() !!}
		</div>
	</div>
	@endif
@else
	<h3 class="text-center">NO HEROES FOUND</h3>
@endif
