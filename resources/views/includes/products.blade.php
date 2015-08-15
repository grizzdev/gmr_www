@foreach($products as $product)
<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 pb-60 shop-product text-center">
	<a href="{{ (!empty($hero_slug)) ? url('product/'.$product->sku.'/'.$hero_slug) : url('product/'.$product->sku) }}">
		@if(!empty($product->files()->first()->id))
		<img src="{{ $product->files()->first()->url() }}" alt="{{ $product->name }}" class="img-responsive" />
		@else
		<img src="http://placehold.it/500x500" alt="{{ $product->name }}" class="img-responsive" />
		@endif
	</a>
	@if($product->contribution_amount)
	<div class="product-contribution">CONTRIBUTES ${{ $product->contribution_amount or 'XX' }} TO CAMPAIGN!</div>
	@endif
	<div class="product-name pt-20 pb-5">
		<a href="{{ (!empty($hero_slug)) ? url('product/'.$product->sku.'/'.$hero_slug) : url('product/'.$product->sku) }}">{{ $product->name }}</a>
	</div>
	@if($product->price > 0)
	<div class="product-price">
		<b>${{ $product->price }}</b>
		@if($product->cost() != $product->price)
		- <b>${{ $product->cost() }}</b>
		@endif
	</div>
	@endif
	<div class="pt-30">
		<a href="{{ (!empty($hero_slug)) ? url('product/'.$product->sku.'/'.$hero_slug) : url('product/'.$product->sku) }}" class="product-button"><i class="fa fa-shopping-cart"></i> BUY NOW</a>
	</div>
</div>
@endforeach
