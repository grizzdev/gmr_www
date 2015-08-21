{!! Form::open(['secure_url' => 'password/email', 'id' => 'forgotForm', 'data-remote' => true]) !!}
<div class="row">
	<div class="col-xs-12">
		<div class="form-group has-feedback">
			{!! Form::label('forgot-email', 'Email Address', ['class' => 'control-label']) !!}
			<div class="input-group">
				{!! Form::email('email', null, ['class' => 'form-control', 'required' => true, 'id' => 'forgot-email']) !!}
				<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<p>Check your email for the reset password link.</p>
	</div>
</div>
{!! Form::close() !!}
