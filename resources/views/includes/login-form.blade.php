{!! Form::open(['url' => url('auth/login'), 'class' => 'login-form', 'data-remote' => true]) !!}
	<div class="form-group has-feedback">
		<div class="input-group">
			{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email address', 'required' => true, 'id' => 'login-email']) !!}
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
	</div>
	<div class="form-group has-feedback">
		<div class="input-group">
			{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'password', 'required' => true, 'id' => 'login-password']) !!}
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
	</div>
	<div class="form-group has-feedback text-center">
		{!! Form::submit('Login', ['class' => 'btn btn-danger']) !!}
	</div>
{!! Form::close() !!}
<a href="#forgotModal" class="forgot-modal-link"><small>Forgot Password?</small></a>
