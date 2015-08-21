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
					@if(Auth::check())
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs"></i> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{ url('my-account') }}"><i class="fa fa-user"></i> My Account</a></li>
							<li><a href="{{ url('my-account/orders') }}"><i class="fa fa-gift"></i> My Orders</a></li>
							<li><a href="{{ url('auth/logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
						</ul>
					</li>
					@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-sign-in"></i>
							<span class="caret"></span>
						</a>
						<div class="dropdown-menu pt-5 pb-5 pl-5 pr-5 text-center">
							{!! Form::open(['url' => secure_url('auth/login'), 'id' => 'loginForm', 'data-remote' => true]) !!}
								<div class="form-group has-feedback">
									<div class="input-group">
										{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email address', 'required' => true, 'id' => 'login-email']) !!}
										<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									</div>
								</div>
								<div class="form-group has-feedback">
									<div class="input-group">
										{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'password', 'required' => true, 'id' => 'login-password']) !!}
										<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									</div>
								</div>
								<div class="form-group has-feedback text-center">
									{!! Form::submit('Login', ['class' => 'btn btn-danger']) !!}
								</div>
							{!! Form::close() !!}
							<a href="#forgotModal" id="forgotModalLink"><small>Forgot Password?</small></a>
						</div>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
