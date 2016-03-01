@if(!empty($hero->id))
<div class="hero-bar{{ (!empty($mt)) ? ' mt-'.$mt : '' }}">
	<div class="hero-bar-inner">
		<div class="row vcenter">
			<div class="col-xs-7 col-sm-8 col-md-5">
				@if($hero->file_id)
				<img src="{{ $hero->file->url() }}" alt="{{ $hero->name }}" class="hidden-xs" />
				@else
				<img src="{{ asset('uploads/2015/05/Profile-generic.jpg') }}" alt="{{ $hero->name }}" class="hidden-xs" />
				@endif
				<h5 class="pt-5 pb-10">{{ $hero->name }}</h5>
				<div class="progress">
					<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ $hero->percent() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $hero->percent() }}%;">
						<span>{{ $hero->percent() }}% Complete</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 hidden-xs hidden-sm">
				<p class="brd-rt brd-lt pl-10 pr-10 text-center">So far, you'll be contributing <b class="hero-contributing">${{ number_format($cart->contribution($hero->id), 2, '.', '') }}</b> to this campaign!</p>
			</div>
			<div class="col-xs-5 col-sm-4 col-md-3 text-center">
				@if(!$hero->funded)
				<a href="{{ url('product/donate/'.$hero->slug) }}" class="btn btn-danger hidden-xs">DONATE TO THIS CAMPAIGN</a>
				<a href="{{ url('product/donate/'.$hero->slug) }}" class="btn btn-danger visible-xs">DONATE NOW</a>
				@endif
			</div>
		</div>
	</div>
</div>
@endif
