<div class="hero-bar{{ (!empty($mt)) ? ' mt-'.$mt : '' }}">
	<div class="hero-bar-inner">
		<div class="row">
			<div class="col-xs-7 col-sm-8 col-md-5 pt-5">
				<img src="{{ $hero->file->url() }}" alt="{{ $hero->name }}" class="hidden-xs" />
				<h5 class="pb-10">{{ $hero->name }}</h5>
				<div class="progress">
					<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ floor((($hero->raised + $hero->contribution_in_cart()) / $hero->goal) * 100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor((($hero->raised + $hero->contribution_in_cart()) / $hero->goal) * 100) }}%;">
						<span>{{ floor((($hero->raised + $hero->contribution_in_cart()) / $hero->goal) * 100) }}% Complete</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 hidden-xs hidden-sm">
				<p class="brd-rt brd-lt mt-5 mb-5 pl-10 pr-10">So far, you'll be contributing <b class="hero-contributing">${{ $hero->contribution_in_cart() }}</b> to this campaign!</p>
			</div>
			<div class="col-xs-5 col-sm-4 col-md-3 pt-18 text-center">
				<a href="{{ url('product/donate/'.$hero->slug) }}" class="btn btn-danger">DONATE TO THIS CAMPAIGN</a>
			</div>
		</div>
	</div>
</div>
