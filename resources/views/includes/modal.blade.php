<div class="modal fade" id="{{ $id }}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">{{ $title }}</h4>
			</div>
			<div class="modal-body">
				{!! $content or null !!}
				@if(!empty($view))
				@include($view)
				@endif
			</div>
			<div class="modal-footer">
				@foreach($buttons as $button)
				{!! $button !!}
				@endforeach
			</div>
		</div>
	</div>
</div>
