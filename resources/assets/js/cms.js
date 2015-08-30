$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$('input[type="file"]').fileupload({
	dataType: 'json',
	done: function (e, data) {
		if (data.result.image.id) {
			$('#file-id').val(data.result.image.id);
			$('#file-name').html(data.result.image.name);
		}
	}
});

$(document).delegate('*[data-toggle="state"]', 'change', function(e) {
	var targetName = $(this).data('target');
	var parentElement = '#'+$(this).data('target')+'-select';
	var countryId = $(this).val();

	$.ajax({
		url: '/checkout/states',
		method: 'POST',
		dataType: 'text',
		data: {
			'name': targetName,
			'country_id': countryId
		}
	}).done(function(response) {
		$(parentElement).html(response);
	});
});

$('[data-toggle="tooltip"]').tooltip();
