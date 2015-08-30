@extends('layouts.master')

@section('content')
@if(session('hero_slug'))
	</section>
	@include('includes.hero-bar', ['hero' => \App\Hero::where('slug', '=', session('hero_slug'))->first(), 'mt' => 75, 'cart' => $cart])
	<section class="container-fluid">
@endif
<div class="row shop-content">
	<div class="col-sm-12 pt-{{ (session('hero_slug')) ? 10 : 85 }} pb-40">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-9">
				@if($products->count())
				<div class="row">
					<div class="hidden-xs hidden-sm col-sm-8">
						<h5 class="">{{ $products->total() }} Product{{ ($products->total() != 1) ? 's' : '' }} Found</h5>
					</div>
					<div class="visible-xs visible-sm col-xs-4">
						{!! Form::open(['url' => 'shop/search', 'id' => 'shopSearchTopForm', 'class' => 'form-inline']) !!}
							<div class="input-group">
								{!! Form::text('shop-search', urldecode($slugs['search']), ['class' => 'form-control', 'placeholder' => 'SEARCH...', 'id' => 'shop-search-top']) !!}
								<span class="input-group-btn">
									<button type="submit" class="btn btn-default pt-7"><i class="fa fa-search"></i></button>
								</span>
							</div>
							{!! Form::hidden('_token', csrf_token()) !!}
						{!! Form::close() !!}
					</div>
					<div class="visible-xs visible-sm col-xs-4">
						{!! Form::select('shop-category', $categories, $slugs['category'], ['class' => 'form-control', 'id' => 'shop-category']) !!}
					</div>
					<div class="col-xs-4 col-sm-4 text-right">
						{!! Form::select('shop-sort', [
							'default' => 'default sorting',
							'newest' => 'newest',
							'most-popular' => 'most popular',
							'alphabetical' => 'alphabetical',
							'highest-contribution' => 'highest contribution'
						], $slugs['sort'], ['class' => 'form-control', 'id' => 'shop-sort']) !!}
					</div>
				</div>
				@endif
				<div class="row multi-columns-row shop-products mt-40">
					@if($products->count())
						@include('includes.products', ['products' => $products, 'hero_slug' => $slugs['hero']]);
					@else
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h2 class="text-center">NO PRODUCTS FOUND</h2>
					</div>
					@endif
				</div>
				<div class="row">
					<div class="col-xs-12 text-center">
						{!! $products->render() !!}
					</div>
				</div>
			</div>
			<div class="hidden-xs hidden-sm col-md-3 shop-sidebar">
				<div class="shop-sidebar-inner">
					<div class="row pb-20">
						<div class="col-xs-12">
							{!! Form::open(['url' => 'shop/search', 'id' => 'shopSearchSideForm']) !!}
								<div class="form-group">
									{!! Form::text('shop-search', urldecode($slugs['search']), ['class' => 'form-control mb-5', 'placeholder' => 'SEARCH FOR PRODUCTS...', 'id' => 'shop-search-side']) !!}
									{!! Form::submit('SEARCH', ['class' => 'btn btn-default']) !!}
								</div>
								{!! Form::hidden('_token', csrf_token()) !!}
							{!! Form::close() !!}
						</div>
					</div>
					<div class="row pb-20">
						<div class="col-xs-12">
							<h5>SORT BY CATEGORY</h5>
							@foreach($categories as $slug => $name)
							<a href="{{ url('shop/category/'.$slug) }}" class="category-link{{ ($slug == $slugs['category']) ? ' active': '' }}" data-slug="{{ $slug }}">{{ $name }}</a>
							@endforeach
						</div>
					</div>
					<div class="row most-popular">
						<div class="col-xs-12">
							<h5>MOST POPULAR PRODUCTS</h5>
							@foreach(\App\Product::popular(3) as $product)
							<div class="row pt-5 pb-5">
								<div class="col-xs-4">
									<a href="{{ url('product/'.$product->slug) }}">
										@if(!empty($product->files()->first()->id))
										<img src="{{ $product->files()->first()->url() }}" alt="{{ $product->name }}" class="img-responsive" />
										@else
										<img src="http://placehold.it/500x500" alt="{{ $product->name }}" class="img-responsive" />
										@endif
									</a>
								</div>
								<div class="col-xs-8">
									<a class="product-name">{{ $product->name }}</a>
									<b>${{ $product->price }}</b>
									@if($product->cost() != $product->price)
									- <b>${{ $product->cost() }}</b>
									@endif
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
