@extends('layouts.master')

@section('content')
<div class="full-width pt-70">
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
				{!! Form::hidden('funded', 1) !!}
				{!! Form::token() !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>
<div class="full-width heroes-content">
	<div class="col-sm-12 col-md-12 col-lg-10 col-lg-offset-1 pt-20 pb-20">
		<div class="heroes-list">
			@include('includes.heroes', ['heroes' => $heroes, 'paginate' => true])
		</div>
	</div>
</div>
@endsection
