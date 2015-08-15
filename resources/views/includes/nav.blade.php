	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url() }}">
					<span class="helper"></span>
					<img src="{{ asset('img/logo.png') }}" alt="Gamerosity" />
				</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{ url('about') }}">Our Story</a></li>
							<li><a href="{{ url('team') }}">Team</a></li>
							<li><a href="{{ url('faq') }}">FAQ</a></li>
							<li><a href="{{ url('contact') }}">Contact</a></li>
						</ul>
					</li>
					<li><a href="{{ url('heroes') }}">Heroes</a></li>
					<li><a href="{{ url('shop') }}">Shop</a></li>
					<li><a href="{{ url('hall-of-heroes') }}">Hall of Heroes</a></li>
					<li><a href="{{ url('nominate-a-hero') }}">Nominate A Hero</a></li>
					<li><a href="{{ url('cart') }}"><i class="fa fa-shopping-cart"></i> (<span id="cart-count">{{ (is_array(session('cart'))) ? count(session('cart')) : 0 }}</span>)</a></li>
					@if(0 && Auth::check())
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs"></i> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{ url('my-account') }}"><i class="fa fa-user"></i> My Account</a></li>
							<li><a href="{{ url('my-account/orders') }}"><i class="fa fa-gift"></i> My Orders</a></li>
							<li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
						</ul>
					</li>
					@elseif(0)
					<li><a href="{{ url('login') }}" title="Sign In To Your Gamerosity Account"><i class="fa fa-sign-in"></i></a></li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
