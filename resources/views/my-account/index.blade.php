@extends('layouts.master')

@section('content')
<div class="account-content pt-100 pb-40">
	<div class="row pb-40">
		<div class="col-sm-12 col-md-10 col-md-offset-1">
			{!! Form::open(['url' => 'my-account', 'id' => 'accountForm', 'data-remote' => true]) !!}
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="form-group has-feedback">
							{!! Form::label('name', 'Your Name', ['class' => 'control-label']) !!}
							<div class="input-group">
								{!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'required' => true, 'id' => 'name']) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-group has-feedback">
							{!! Form::label('user-email', 'Your Email', ['class' => 'control-label']) !!}
							<div class="input-group">
								{!! Form::email('email', Auth::user()->email, ['class' => 'form-control', 'required' => true, 'id' => 'user-email']) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="form-group has-feedback">
							{!! Form::label('user-password', 'Password', ['class' => 'control-label']) !!}
							<div class="input-group">
								{!! Form::password('password', ['class' => 'form-control', 'id' => 'user-password', 'data-minlength' => 6]) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-group has-feedback">
							{!! Form::label('user-password-confirm', 'Confirm Password', ['class' => 'control-label']) !!}
							<div class="input-group">
								{!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'user-password-confirm', 'data-minlength' => 6, 'data-match' => '#user-password']) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 text-right">
						{!! Form::submit('Save', ['class' => 'btn btn-danger', 'data-disable-with' => 'Saving...']) !!}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-5 col-md-offset-1">
			<h3>Recent Orders</h3>
			@include('includes.account-orders', [
				'user' => $user,
				'orders' => $orders,
				'paginate' => false
			])
		</div>
		<div class="col-sm-12 col-md-5">
			<h3>Logs</h3>
			@include('includes.account-logs', [
				'user' => $user,
				'logs' => $logs,
				'paginate' => false
			])
		</div>
	</div>
</div>
@endsection
