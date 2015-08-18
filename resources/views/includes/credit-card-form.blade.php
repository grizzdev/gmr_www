<form id="creditCardForm">
	<div class="row">
		<div class="col-xs-12">
			<div class="form-group has-feedback">
				<label for="credit-card-number" class="control-label">Number</label>
				<div class="input-group">
					<input type="text" maxlength="16" name="credit-card-number" class="form-control" data-min-length="15" pattern="[0-9]{15,16}"required />
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6">
			<label for="credit-card-expiration" class="control-label">Expiration Date</label>
			<div class="row">
				<div class="col-xs-6">
					<select name="credit-card-expiration-month" class="form-control">
						@for($i = 1; $i <= 12; $i++)
						<option value="{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}">{{ $i }}</option>
						@endfor
					</select>
				</div>
				<div class="col-xs-6">
					<select name="credit-card-expiration-year" class="form-control">
						@for($y = date('Y'); $y < (date('Y') + 16); $y++)
						<option value="{{ $y }}">{{ $y }}</option>
						@endfor
					</select>
				</div>
			</div>
		</div>
		<div class="col-xs-6">
			<div class="form-group has-feedback">
				<label for="credit-card-ccv" class="control-label">CCV/CCID</label>
				<div class="input-group">
					<input type="text" maxlength="4" name="credit-card-ccv" class="form-control" data-min-length="3" pattern="[0-9]{3,4}" required />
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
			</div>
		</div>
	</div>
	{!! Form::hidden('_token', csrf_token()) !!}
{!! Form::close() !!}
