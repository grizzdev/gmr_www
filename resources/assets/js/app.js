$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=151302161680776";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location)?'http':'https';
	if (!d.getElementById(id)) {
		js = d.createElement(s);
		js.id = id;
		js.src = p+'://platform.twitter.com/widgets.js';
		fjs.parentNode.insertBefore(js, fjs);
	} }(document, 'script', 'twitter-wjs'));

new WOW().init();

$('[data-toggle="tooltip"]').tooltip();

$('input[type="file"]').fileupload({
	dataType: 'json',
	done: function (e, data) {
		if (data.result.image.id) {
			$('#file-id').val(data.result.image.id);
			$('#file-name').html(data.result.image.name);
		}
	}
});

$(document).delegate('*[data-toggle="lightbox"]', 'click', function(e) {
	e.preventDefault();
	return $(this).ekkoLightbox({
		always_show_close: true
	});
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

$('#cart-content').on('click', '.btn-coupon', function(e) {
	if ($('#coupon_code').val() != '') {
		$('#cartForm').submit();
	}
});

$('.link-to-top').on('click', function(e) {
	e.preventDefault();
	$('html, body').animate({ scrollTop: 0 }, 'slow');
});

$('#forgotModalLink').on('click', function(e) {
	e.preventDefault();
	$('#forgotModal').modal('show');
});

$('#forgotModal').on('click', '.btn-danger', function(e) {
	e.preventDefault();
	$('#forgotForm').submit();
});

$('#loginForm').validator({
	disable: true
}).on('submit', function(e) {
	if (e.isDefaultPrevented()) {
		return false;
	}
}).on('ajax:success', function(e, data, status, xhr) {
	if (typeof data.error === 'undefined') {
		document.location.href = '/my-account';
	} else {
		showModal('errorModal', data.error, 'Error!');
	}
}).on('ajax:error', function(e, data, status, xhr) {
	showModal('errorModal', '<p>An unspecified error has occurred.</p><p>Please try again later.</p>', 'Error!');
});

$('#forgotForm').validator({
	disable: true
}).on('submit', function(e) {
	if (e.isDefaultPrevented()) {
		return false;
	}
}).on('ajax:success', function(e, data, status, xhr) {
	$('#forgotForm .row').find('.col-xs-12:first-child').hide();
	$('#forgotForm .row').find('.col-xs-12:last-child').show();
	$('#forgotModal .modal-footer button').hide();
}).on('ajax:error', function(e, data, status, xhr) {
	showModal('errorModal', '<p>An unspecified error has occurred.</p><p>Please try again later.</p>', 'Error!');
});

$('#resetForm').validator({
	disable: true
}).on('submit', function(e) {
	if (e.isDefaultPrevented()) {
		return false;
	}
}).on('ajax:success', function(e, data, status, xhr) {
	document.location.href = '/';
}).on('ajax:error', function(e, data, status, xhr) {
	showModal('errorModal', '<p>An unspecified error has occurred.</p><p>Please try again later.</p>', 'Error!');
});

$('#contactForm').validator({
	disable: true
}).on('submit', function(e) {
	if (e.isDefaultPrevented()) {
		$('html, body').animate({ scrollTop: 0 }, 'slow');
		return false;
	}
}).on('ajax:success', function(e, data, status, xhr) {
	$('#contactModal').modal('show');
	$('#contactForm')[0].reset();
	$('#contactForm').find('.has-success').removeClass('has-success');
	$('#contactForm').find('.form-control-feedback').removeClass('glyphicon-ok');
}).on('ajax:error', function(e, data, status, xhr) {
	showModal('errorModal', '<p>An unspecified error has occurred.</p><p>Please try again later.</p>', 'Error!');
});

$('#nominateForm').validator({
	disable: true,
}).on('submit', function(e) {
	if (e.isDefaultPrevented()) {
		$('html, body').animate({ scrollTop: 0 }, 'slow');
		return false;
	}
}).on('ajax:success', function(e, data, status, xhr) {
	$('#nominateModal').modal('show');
	$('#nominateForm')[0].reset();
	$('#nominateForm').find('.has-success').removeClass('has-success');
	$('#nominateForm').find('.form-control-feedback').removeClass('glyphicon-ok');
}).on('ajax:error', function(e, data, status, xhr) {
	showModal('errorModal', '<p>An unspecified error has occurred.</p><p>Please try again later.</p>', 'Error!');
});

$('#productFrom').validator({
	disable: true,
}).on('submit', function(e) {
	if (e.isDefaultPrevented()) {
		return false;
	}
}).on('ajax:success', function(e, data, status, xhr) {
	$('#cart-count').html(data.count);
	$('#productModal').modal('show');

	if ($('.hero-bar').length) {
		$('.hero-contributing').html('$'+parseFloat(data.contribution).toFixed(2));
		$('.hero-bar').find('.progress-bar').attr('aria-valuenow', data.percentage).css('width', data.percentage+'%');
		$('.hero-bar').find('.progress-bar span').html(data.percentage+'%');
	}
}).on('ajax:error', function(e, data, status, xhr) {
	showModal('errorModal', '<p>An unspecified error has occurred.</p><p>Please try again later.</p>', 'Error!');
});

$('#accountForm').validator({
	disable: true
}).on('submit', function(e) {
	if (e.isDefaultPrevented()) {
		return false;
	}
}).on('ajax:success', function(e, data, status, xhr) {
	if (typeof data.error === 'undefined') {
		showModal('errorModal', 'Account Saved', 'Success!');
	} else {
		showModal('errorModal', data.error, 'Error!');
	}
}).on('ajax:error', function(e, data, status, xhr) {
	showModal('errorModal', '<p>An unspecified error has occurred.</p><p>Please try again later.</p>', 'Error!');
});

$('#cart-content').on('ajax:success', '#cartForm', function(e, data, status, xhr) {
	$('#cart-content').html(data.view);
	$('#cart-count').html(data.count);
}).on('ajax:error', function(e, data, status, xhr) {
	showModal('errorModal', '<p>An unspecified error has occurred.</p><p>Please try again later.</p>', 'Error!');
});

$('.btn-cancel-order').bind('ajax:success', function(e, data, status, xhr) {
	document.location.href = document.location.href;
}).bind('ajax:error', function(e, data, status, xhr) {
	showModal('errorModal', '<p>An unspecified error has occurred.</p><p>Please try again later.</p>', 'Error!');
});

if ($('#checkoutForm').length) {
	$('#same-as-billing').on('change', function() {
		if ($(this).prop('checked')) {
			if ($('#shipping-country-id').val() != $('#billing-country-id').val()) {
				setShippingCountry();
			} else {
				$('#shipping-state-id').val($('#billing-state-id').val());
			}
			$('#shipping-address-1').val($('#billing-address-1').val());
			$('#shipping-address-2').val($('#billing-address-2').val());
			$('#shipping-city').val($('#billing-city').val());
			$('#shipping-zip').val($('#billing-zip').val());
			$('.shipping-details').find('input, select').not('[type="checkbox"]').prop('disabled', true);
		} else {
			$('.shipping-details').find('input, select').not('[type="checkbox"]').prop('disabled', false);
		}
	});

	$('#same-as-billing').trigger('change');

	$('#billing-country-id').on('change', function() {
		if ($('#same-as-billing').prop('checked')) {
			setShippingCountry();
		}
	});

	$('#checkoutForm').on('change', '#billing-state-id', function() {
		if ($('#same-as-billing').prop('checked')) {
			$('#shipping-state-id').val($('#billing-state-id').val());
			$('#shipping-state-id').trigger('change');
		}
	});

	$('.billing-details').find('input').on('keyup', function() {
		if ($('#same-as-billing').prop('checked')) {
			var sisterElement = $(this).prop('id').replace('billing', 'shipping');
			$('#'+sisterElement).val($(this).val());
		}
	});

	$('.gamerosity-donation').on({
		'change': function() {
			calculate_total();
		},
		'keyup': function() {
			calculate_total();
		}
	});

	var handler = StripeCheckout.configure({
		key: $('#stripe-pk').val(),
		image: '/img/logo_hero_128x128.png',
		token: function(token) {
			$('#payment-token').val(token.id);
			$('#checkoutForm').submit();
		}
	});

	$('.credit-card-button').on('click', function(e) {
		e.preventDefault();
		$('#payment-type').val('stripe');
		$('#checkoutForm').submit();
	});

	$('.pay-pal-button').on('click', function(e) {
		e.preventDefault();
		$('#payment-type').val('paypal');
		$('#checkoutForm').submit();
	});

	$(window).on('popstate', function() {
		handler.close();
	});

	$('#checkoutForm').validator({
		disable: true,
	}).on('submit', function(e) {
		if (e.isDefaultPrevented()) {
			$('html, body').animate({ scrollTop: 0 }, 'slow');
			$('#errorModal').modal('show');
			return false;
		} else if ($('#payment-type').val() == 'stripe' && $('#payment-token').val() == '') {
			handler.open({
				name: 'Gamerosity.com',
				amount: ($('#total').val() * 100),
				email: $('#email-address').val(),
				allowRememberMe: false
			});
			return false;
		} else if($('#payment-type').val() == 'paypal' && $('#payment-token').val() == '') {
			$.ajax({
				url: '/checkout/paypal',
				method: 'POST',
				dataType: 'json',
				data: $('#checkoutForm').serialize()
			}).done(function(response) {
				if (response.ACK == "Success") {
					$('#payment-token').val(response.TOKEN);
					$('#checkoutForm').submit();
					if (response.REDIRECT_URL) {
						document.location.href = response.REDIRECT_URL+response.TOKEN;
					}
				}
			});
			return false;
		}
	}).on('ajax:success', function(e, data, status, xhr) {
		if (data.hash) {
			document.location.href = '/order/'+data.hash;
		}
	}).on('ajax:error', function(e, data, status, xhr) {
		showModal('errorModal', '<p>An unspecified error has occurred.</p><p>Please try again later.</p>', 'Error!');
	});
}

if ($('.hero-bar').length) {
	$('.hero-bar').height($(".hero-bar-inner").height());

	$('.hero-bar-inner').affix({
		offset: {
			top: ($('.hero-bar-inner').offset().top - 75)
		}
	});
}

if ($('.shop-sidebar').length) {
	$('.shop-sidebar-inner').affix({
		offset: {
			top: 0,
			bottom: 510
		}
	});
}

if ($('#shop-category').length) {
	$('#shop-category').on('change', function() {
		var url = '';
		for (s = 1; s <= $.url().segment().length; s++) {
			if ($.url().segment(s) != 'category') {
				url = url+'/'+$.url().segment(s);
			} else {
				s++;
			}
		}
		url = url+'/category/'+$(this).val();
		document.location.href = url;
	});
}

if ($('#shop-sort').length) {
	$('#shop-sort').on('change', function() {
		var url = '';
		for (s = 1; s <= $.url().segment().length; s++) {
			if ($.url().segment(s) != 'sort') {
				url = url+'/'+$.url().segment(s);
			} else {
				s++;
			}
		}
		url = url+'/sort/'+$(this).val();
		document.location.href = url;
	});
}

if ($('#shopSearchTopForm').length) {
	$('#shopSearchTopForm').on('submit', function(e) {
		e.preventDefault();
		document.location.href = '/shop/search/'+$('#shop-search-top').val().replace(/ /g, '+');
	});
}

if ($('#shopSearchSideForm').length) {
	$('#shopSearchSideForm').on('submit', function(e) {
		e.preventDefault();
		document.location.href = '/shop/search/'+$('#shop-search-side').val().replace(/ /g, '+');
	});
}

if ($('a.category-link').length) {
	$('a.category-link').on('mouseover', function() {
		var url = '/shop/category/'+$(this).data('slug');
		for (s = 2; s <= $.url().segment().length; s++) {
			if ($.url().segment(s) != 'category') {
				url = url+'/'+$.url().segment(s);
			} else {
				s++;
			}
		}
		$(this).attr('href', url);
	});
}

$('.form-hero').on('submit', function(e) {
	e.preventDefault();
	var id = $
	$.ajax({
		url: $(this).attr('action'),
		method: 'POST',
		dataType: 'json',
		data: $(this).serialize(),
	}).done(function(response) {
		$('.tr-'+response.id).addClass('success');
	});
});

if ($('#heroesSearchForm').length) {
	$('#heroesSearchForm').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: $(this).attr('action'),
			method: 'POST',
			dataType: 'html',
			data: $(this).serialize(),
		}).done(function(response) {
			$('.heroes-list').html(response);
		});
	});
}

function setShippingCountry() {
	var stateId = $('#billing-state-id').val();
	var countryId = $('#billing-country-id').val();
	var targetName = 'shipping-state-id';
	var parentElement = '#shipping-state-id-select';
	var isDisabled = ($('#same-as-billing').prop('checked')) ? false : true;

	$('#shipping-country-id').val($('#billing-country-id').val());

	$.ajax({
		url: '/checkout/states',
		method: 'POST',
		dataType: 'text',
		data: {
			'name': targetName,
			'country_id': countryId,
			'selected': stateId,
			'disabled': isDisabled
		}
	}).done(function(response) {
		$(parentElement).html(response);
	});
}

function calculate_total() {
	var subtotal = parseFloat($('#subtotal').val());
	var shipping = parseFloat($('.cart-shipping').html().replace('$', ''));
	var donation = parseInt($('.gamerosity-donation').val());

	if (!isNaN(donation)) {
		subtotal += donation;
	}

	var total = subtotal;

	if (!isNaN(shipping)) {
		total = (total + shipping);
	}

	if ($('.cart-discount').length) {
		var discount = parseFloat($('.cart-discount').html().replace('- $', ''));
		if (!isNaN(discount)) {
			total -= discount;
		}
	}

	$('.cart-subtotal').html('$'+subtotal.toFixed(2));
	$('.cart-total').html('$'+total.toFixed(2));
	$('#total').val(total);
}

function showModal(id, content, title, buttons) {
	content = ((typeof content !== 'undefined') ? content : null);
	title = ((typeof title !== 'undefined') ? title : null);
	buttons = ((typeof buttons !== 'undefined') ? buttons : []);

	if ($('#'+id).length) {
		$('#'+id).find('.modal-title').html(title);
		$('#'+id).find('.modal-body').html(content);
		$('#'+id).find('.modal-footer').html('');
		$(buttons).each(function(i, button) {
			$(button).appendTo('.modal-footer')
		});
		$('#'+id).modal('show');
	}
}
