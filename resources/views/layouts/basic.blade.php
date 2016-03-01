<!DOCTYPE html>
<html>
	<head>
		<title>{{ $title or null}} | Gamerosity</title>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="csrf-param" content="_token" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="canonical" href="{{ Request::url() }}" />
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
		<meta property="og:url" content="{{ Request::url() }}" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="{{ $title or null }} | Gamerosity" />
		<meta property="og:description" content="{{ (Request::is('hero/*')) ? $hero->overview : 'Gamerosity' }}" />
		<meta property="og:image" content="{{ (Request::is('hero/*') && $hero->file) ? asset($hero->file->url()) : asset('img/footer.png') }}" />
		<script>
			!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
			n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
			document,'script','//connect.facebook.net/en_US/fbevents.js');

			fbq('init', '896493440470872');
			fbq('track', "PageView");
		</script>
		<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=896493440470872&ev=PageView&noscript=1" /></noscript>
		@yield('head')
	</head>
	<body>
		@yield('page')
		@yield('foot')
	</body>
</html>
