<!DOCTYPE html>
<html>
	<head>
		<title>{{ $title or null}} | Gamerosity</title>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="csrf-param" content="_token" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="canonical" href="{{ url() }}" />
		<link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}" />
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="16x16">
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="32x32">
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="96x96">
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="160x160">
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="192x192">
		<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon.png') }}">
		<meta name="msapplication-square70x70logo" content="{{ asset('img/favicon.png') }}" />
		<meta name="msapplication-square150x150logo" content="{{ asset('img/favicon.png') }}" />
		<meta name="msapplication-wide310x150logo" content="{{ asset('img/favicon.png') }}" />
		<meta property="og:url" content="{{ config('app.url') }}" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="{{ $title or null }} | Gamerosity" />
		<meta property="og:description" content="{{ $description or 'Gamerosity' }}" />
		<meta property="og:image" content="{{ asset('img/footer.png') }}" />
	</head>
	<body>
		@yield('page')
		<div id="fb-root"></div>
		<script src="https://checkout.stripe.com/checkout.js"></script>
		<script src="{{ elixir('js/all.js') }}"></script>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-50032356-5', 'auto');
			ga('send', 'pageview');
		</script>
	</body>
</html>
