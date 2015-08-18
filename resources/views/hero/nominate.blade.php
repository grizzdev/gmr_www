@extends('layouts.master')

@section('content')
<div class="nominate-form pt-120 pb-40">
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-3">
			{!! Form::open(['url' => 'nominate-a-hero', 'data-remote' => 'true', 'id' => 'nominateForm', 'files' => true]) !!}
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="form-group has-feedback">
							{!! Form::label('name', 'Your Name', ['class' => 'control-label']) !!}
							<div class="input-group">
								{!! Form::text('name', null, ['class' => 'form-control', 'required' => true]) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-group has-feedback">
							{!! Form::label('email', 'Your Email', ['class' => 'control-label']) !!}
							<div class="input-group">
								{!! Form::email('email', null, ['class' => 'form-control', 'required' => true]) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="form-group has-feedback">
							{!! Form::label('relationship', 'Relationship to Hero', ['class' => 'control-label']) !!}
							<div class="input-group">
								{!! Form::text('relationship', null, ['class' => 'form-control', 'required' => true]) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-group has-feedback">
							{!! Form::label('hero-name', 'Hero\'s Name', ['class' => 'control-label']) !!}
							<div class="input-group">
								{!! Form::text('hero-name', null, ['class' => 'form-control', 'required' => true]) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('hero-dob', 'Hero\'s Birthday', ['class' => 'control-label']) !!}
					<div class="input-group">
						<div class="row">
							<div class="col-sm-12 col-md-6 pb-5">
								{!! Form::select('hero-dob-month', $months, null, ['class' => 'form-control']) !!}
							</div>
							<div class="col-sm-12 col-md-3 pb-5">
								{!! Form::select('hero-dob-day', $days, null, ['class' => 'form-control']) !!}
							</div>
							<div class="col-sm-12 col-md-3">
								{!! Form::select('hero-dob-year', $years, null, ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
				</div>
				<div class="form-group has-feedback">
					{!! Form::label('hero-address', 'Hero\'s Shipping Address', ['class' => 'control-label']) !!}
					<div class="input-group">
						{!! Form::text('hero-address', null, ['class' => 'form-control', 'required' => true]) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-5">
						<div class="form-group has-feedback">
							{!! Form::label('hero-city', 'Hero\'s City', ['class' => 'control-label']) !!}
							<div class="input-group">
								{!! Form::text('hero-city', null, ['class' => 'form-control', 'required' => true]) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-4">
						<div class="form-group has-feedback">
							{!! Form::label('hero-state-id', 'Hero\'s State', ['class' => 'control-label']) !!}
							{!! Form::select('hero-state-id', $states, null, ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="col-sm-12 col-md-3">
						<div class="form-group has-feedback">
							{!! Form::label('hero-zip', 'Hero\'s Zip', ['class' => 'control-label']) !!}
							<div class="input-group">
								{!! Form::text('hero-zip', null, ['class' => 'form-control', 'required' => true]) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('overview', 'Overview', ['class' => 'control-label']) !!}
					<div class="input-group">
						{!! Form::textarea('overview', null, ['class' => 'form-control', 'required' => true, 'rows' => 5]) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('cancer', 'Type(s) of Cancer', ['class' => 'control-label']) !!}
					<div class="input-group">
						{!! Form::text('cancer', null, ['class' => 'form-control', 'required' => true]) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							{!! Form::label('hospital-name', 'Hospital Name', ['class' => 'control-label']) !!}
							<div class="input-group">
								{!! Form::text('hospital-name', null, ['class' => 'form-control', 'required' => true]) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							{!! Form::label('hospital-location', 'Hospital City, State', ['class' => 'control-label']) !!}
							<div class="input-group">
								{!! Form::text('hospital-location', null, ['class' => 'form-control', 'required' => true]) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							{!! Form::label('image', 'Hero\'s Picture', ['class' => 'control-label']) !!}
							<div type="input-group">
								<span class="btn btn-primary fileinput-button">
									<i class="glyphicon glyphicon-plus"></i>
									<span>Add Image</span>
									{!! Form::file('image', ['data-url' => 'upload']) !!}
								</span>
								<span id="file-name"></span>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							{!! Form::label('hero-shirt-size', 'Hero\'s Shirt Size' , ['class' => 'control-label']) !!}
							{!! Form::select('hero-shirt-size', $sizes, null, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
				<div class="form-group">
					<h4>Social Networking Sites</h4>
					<small>Enter full url</small>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								{!! Form::label('facebook-url', 'Facebook', ['class' => 'control-label']) !!}
								{!! Form::text('facebook-url', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								{!! Form::label('twitter-url', 'Twitter', ['class' => 'control-label']) !!}
								{!! Form::text('twitter-url', null, ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								{!! Form::label('youtube-url', 'YouTube', ['class' => 'control-label']) !!}
								{!! Form::text('youtube-url', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								{!! Form::label('caringbridge-url', 'Caring Bridge', ['class' => 'control-label']) !!}
								{!! Form::text('caringbridge-url', null, ['class' => 'form-control']) !!}
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<h4>Terms and Conditions</h4>
						<small>Please review our <a href="#" data-toggle="modal" data-target="#termsAndConditionsModal">terms and conditions</a> before proceeding.</small>
						<div class="checkbox">
							<label>
								{!! Form::checkbox('t-n-c', null, false, ['required' => true]) !!}
								I agree to Gamerosity Terms and Conditions
							</label>
						</div>
						<div class="checkbox">
							<label>
								{!! Form::checkbox('authorized', null, false, ['required' => true]) !!}
								I am authorized to nominate this child
							</label>
						</div>
					</div>
				</div>
				<div class="form-group text-right">
					{!! Form::submit('Send Nomination', ['class' => 'btn btn-danger', 'data-disable-with' => 'Nominating...']) !!}
				</div>
				{!! Form::hidden('file-id', null, ['id' => 'file-id']) !!}
				{!! Form::token() !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>
<div class="modal fade" id="nominateModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Success!</h4>
			</div>
			<div class="modal-body">
				<p>Thanks for your nomination.<br />We'll review your submission, and respond soon.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="termsAndConditionsModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Terms and Conditions</h4>
			</div>
			<div class="modal-body">
				@include('includes.termsandconditions')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection
