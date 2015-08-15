@extends('layouts.master')

@section('content')
<div class="contact-content pt-120 pb-40">
	<div class="row">
		<div class="col-sm-12 col-md-10 col-md-offset-1">
			<div class="row">
				<div class="col-xs-12 pb-30">
					<p>We try our best to respond as soon as possible! <a href="mailto:info@gamerosity.com">Email</a> and <a href="http://fb.me/gamerosity">Facebook</a> are usually the best way to get in touch with us fairly quickly. Our phone number is a Google Voice number that redirects to our cell phones. Meaning, we’re available for phone calls during business hours (9-5pm Pacific). If we don’t answer, chances are we’re working or hanging with our family. :)</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4 pb-20">
					<div class="contact-item">
						<div class="contact-item-icon">
							<i class="fa fa-phone"></i>
						</div>
						<div class="contact-item-title">Phone Number</div>
						<div class="contact-item-text">541.690.8124</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4 pb-20">
					<div class="contact-item">
						<div class="contact-item-icon">
							<i class="fa fa-paper-plane"></i>
						</div>
						<div class="contact-item-title">mailing</div>
						<div class="contact-item-text">1750 Delta Waters Rd.<br />Ste 102 PMB 246<br />Medford, OR<br />97504</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="contact-item">
						<div class="contact-item-icon">
							<i class="fa fa-envelope"></i>
						</div>
						<div class="contact-item-title">email</div>
						<div class="contact-item-text"><a href="mailto:info@gamerosity.com">info@gamerosity.com</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="contact-form pb-70">
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-3">
			{!! Form::open(['url' => 'contact', 'id' => 'contactForm', 'data-remote' => true]) !!}
				<div class="form-group has-feedback">
					{!! Form::label('name', 'Your Name', ['class' => 'control-label']) !!}
					<div class="input-group">
						{!! Form::text('name', null, ['class' => 'form-control', 'required' => true]) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group has-feedback">
					{!! Form::label('email', 'Your Email', ['class' => 'control-label']) !!}
					<div class="input-group">
						{!! Form::email('email', null, ['class' => 'form-control', 'required' => true]) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group has-feedback">
					{!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
					<div class="input-group">
						{!! Form::text('subject', null, ['class' => 'form-control', 'required' => true]) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group has-feedback">
					{!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
					<div class="input-group">
						{!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => 5, 'required' => true]) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group text-right">
					{!! Form::submit('Send', ['class' => 'btn btn-primary', 'data-disable-with' => 'Sending...']) !!}
				</div>
				{!! Form::token() !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>
<div class="modal fade" id="contactModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Success!</h4>
			</div>
			<div class="modal-body">
				<p>Thanks for writing.<br />We'll get back to you soon.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection
