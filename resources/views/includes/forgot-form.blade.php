{!! Form::open(['url' => url('password/email'), 'id' => 'forgotForm', 'data-remote' => true]) !!}
<div class="row">
	<div class="col-xs-12">
		<div class="form-group has-feedback">
			{!! Form::label('forgot-email', 'Reset Password', ['class' => 'control-label']) !!}
			<div class="input-group">
				{!! Form::email('email', null, ['class' => 'form-control', 'required' => true, 'id' => 'forgot-email', 'placeholder' => 'Email Address']) !!}
				<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		{!! Form::submit('Reset Password', ['class' => 'btn btn-danger', 'data-disable-with' => 'Resetting...']) !!}
		<a href="{{ url('') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
	</div>
	<div class="col-xs-12 pt-10">
		<p class="form-result"></p>
	</div>
</div>
{!! Form::close() !!}
