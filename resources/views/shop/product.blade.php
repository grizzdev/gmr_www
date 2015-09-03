@extends('layouts.master')

@section('content')
@if(session('hero_slug'))
	</section>
	@include('includes.hero-bar', ['hero' => \App\Hero::where('slug', '=', session('hero_slug'))->first(), 'mt' => 75])
	<section class="container-fluid">
@endif
<div class="product-content pt-{{ (session('hero_slug')) ? 15 : 85 }} pb-40">
	<div class="row">
		<div class="col-sm-12 col-md-10 col-md-offset-1">
			<div class="row">
				<div class="col-sm-12 col-md-4 pb-30">
					<div class="row">
						<div class="col-xs-12 pb-10">
							@if(!empty($product->files()->first()->id))
							<a href="{{ $product->files()->first()->url() }}" data-toggle="lightbox" data-gallery="product" data-title="{{ $product->files()->first()->name }}">
								<img src="{{ $product->files()->first()->url() }}" alt="{{ $product->name }}" class="img-responsive img-rounded" />
							</a>
							@endif
						</div>
					</div>
					<div class="row">
					@foreach($product->files as $key => $image)
						@if($key > 0)
						<div class="col-xs-3 text-center pb-10">
							<a href="{{ $image->url() }}" data-toggle="lightbox" data-gallery="product" data-title="{{ $image->name }}">
								<img src="{{ $image->url() }}" alt="{{ $product->name }}" class="img-thumbnail" />
							</a>
						</div>
						@endif
					@endforeach
					</div>
				</div>
				<div class="col-sm-12 col-md-8">
					<div class="row">
						<div class="col-xs-12">
							<h2>{{ $product->name }}</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<hr />
						</div>
					</div>
					@if($product->price > 0)
					<div class="row">
						<div class="col-xs-12">
							@if($product->sale_price != 0 && $product->sale_price != $product->price)
							<h3><strike>${{ $product->price }}</strike> ${{ $product->sale_price }}</h3>
							@else
							<h3>${{ $product->price }}</h3>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<hr />
						</div>
					</div>
					@endif
					<div class="row">
						<div class="col-xs-12">
							<p>{!! nl2br($product->short_description) !!}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<hr />
						</div>
					</div>
					<form action="{{ url('cart') }}" method="PUT" id="productFrom" data-remote="true">
					@foreach($product->attributes as $attribute)
						@if(is_null($attribute->parent_id))
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label class="control-label">{{ $attribute->name }}</label>
									@if($attribute->type == 'select')
										<select name="attributes[{{ $attribute->id }}]" class="form-control" required>
											<option value=""> -- select --</option>
										@foreach($product->attributes as $attr)
											@if($attr->parent_id == $attribute->id)
											<option value="{{ $attr->id }}">
												{{ $attr->name }}
												@if($attr->price)
												+ ${{ $attr->price }}
												@endif
											</option>
											@endif
										@endforeach
										</select>
									@elseif($attribute->type == 'model' && !empty($attribute->model))
										<select name="attributes[{{ $attribute->id }}]" class="form-control" required>
										<?php $modelname = '\\App\\'.$attribute->model; ?>
											<option value=""> -- select --</option>
										@foreach($modelname::where('active', '=', 1)->where('funded', '=', 0)->orderBy('order', 'DESC')->orderBy('name')->get() as $model)
											<option value="{{ $model->id }}"
											@if(!empty($hero->slug) && $model->slug == $hero->slug)
											selected
											@elseif(session('hero_slug') && $model->slug == session('hero_slug'))
											selected
											@endif
											>{{ $model->name }}</option>
										@endforeach
										</select>
									@elseif($attribute->type == 'text')
										{!! Form::text('attributes['.$attribute->id.']', null, ['class' => 'form-control', 'required' => true]) !!}
									@elseif($attribute->type == 'number')
										{!! Form::number('attributes['.$attribute->id.']', null, ['class' => 'form-control', 'required' => true]) !!}
									@elseif($attribute->type == 'currency')
										<div class="input-group">
											<span class="input-group-addon">$</span>
											{!! Form::number('attributes['.$attribute->id.']', null, ['class' => 'form-control', 'required' => true]) !!}
											<span class="input-group-addon">.00</span>
										</div>
									@endif
								</div>
							</div>
						</div>
						@endif
					@endforeach
						<div class="row">
							<div class="col-xs-2">
								{!! Form::number('quantity', 1, ['class' => 'form-control']) !!}
							</div>
							<div class="col-xs-10">
								{!! Form::submit('ADD TO CART', ['class' => 'btn btn-primary', 'data-disable-with' => 'ADDING...']) !!}
							</div>
						</div>
						{!! Form::hidden('product_id', $product->id) !!}
						{!! Form::hidden('_token', csrf_token()) !!}
					{!! Form::close() !!}
					<div class="row">
						<div class="col-xs-12">
							<hr />
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							SKU: {{ strtoupper($product->sku) }}
						</div>
					</div>
					@if($product->categories->count())
					<div class="row">
						<div class="col-xs-12">
							Categories:
							@foreach($product->categories as $category)
							<a href="{{ url('shop/category/'.$category->slug) }}">{{ $category->name }}</a>
							@endforeach
						</div>
					</div>
					@endif
					@if($product->tags->count())
					<div class="row">
						<div class="col-xs-12">
							Tags:
							@foreach($product->tags as $tag)
							<a href="{{ url('shop/tag/'.$tag->slug) }}">{{ $tag->name }}</a>
							@endforeach
						</div>
					</div>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
						<li role="presentation"><a href="#additional-information" aria-controls="additional-information" role="tab" data-toggle="tab">Additional Information</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="description"><p>{!! nl2br($product->description) !!}</p></div>
						<div role="tabpanel" class="tab-pane" id="additional-information">
							<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Attribute</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>
								@foreach($product->attributes as $attribute)
									@if(is_null($attribute->parent_id) && $attribute->type != 'model')
									<tr>
										<td>{{ $attribute->name }}</td>
										<td>
										@foreach($product->attributes as $key => $option)
											@if($option->parent_id == $attribute->id)
											{{ $option->name }}@if($key < ($attribute->children->count() - 1)), @endif
											@endif
										@endforeach
										</td>
									</tr>
									@endif
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('includes.modal', [
	'id' => 'productModal',
	'title' => 'Success!',
	'content' => '<p>'.$product->name.' added to cart.</p>',
	'buttons' => [
		'<a href="'.url('cart').'" class="btn btn-primary">View Cart</a>',
		'<button type="button" class="btn btn-default" data-dismiss="modal">Continue Shopping</button>'
	]
]);
@endsection
