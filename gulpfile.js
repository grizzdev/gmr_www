var elixir = require('laravel-elixir');

elixir(function(mix) {
	mix.sass('app.scss');
	mix.sass('cms.scss');

	mix.scripts([
		'jquery-2.1.4.min.js',
		'jquery-ui.js',
		'../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
		'validator.js',
		'upload.js',
		'ujs.js',
		'cms.js'
	], 'public/js/cms.js');

	mix.scripts([
		'jquery-2.1.4.min.js',
		'jquery-ui.js',
		'../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
		'lightbox.js',
		'validator.js',
		'upload.js',
		'wow.js',
		'purl.js',
		'ujs.js',
		'video.js',
		'slick.js',
		'app.js'
	], 'public/js/all.js');

	mix.version([
		'public/css/app.css',
		'public/js/all.js',
		'public/css/cms.css',
		'public/js/cms.js'
	]);
});
