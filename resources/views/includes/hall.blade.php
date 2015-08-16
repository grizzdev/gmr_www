<div class="hero-content">
	<a href="{{ url('hero/'.$hero->slug) }}">
		@if($hero->file_id)
		<img src="{{ $hero->file->url() }}" alt="{{ $hero->name }}" class="img-responsive img-rounded" />
		@else
		<img src="{{ asset('uploads/2015/05/Profile-generic.jpg') }}" alt="{{ $hero->name }}" class="img-responsive img-rounded" />
		@endif
	</a>
	<div class="hero-name pl-10 pr-10">
		<a href="{{ url('hero/'.$hero->slug) }}">{{ $hero->name }}, {{ $hero->age() }}</a>
	</div>
	<div class="hero-illness pl-10 pr-10">{{ $hero->cancer_type }}</div>
	<div class="hero-hospital pl-10 pr-10">{{ $hero->hospital_name }}</div>
	<div class="hero-progress pt-30 pl-10 pr-10">
		<div class="row pb-6">
			<div class="col-xs-12">
				<b>FUNDED!</b>
			</div>
		</div>
		<div class="row pb-6">
			<div class="col-xs-12">
				<div class="progress">
					<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
						<span>100% Complete</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
