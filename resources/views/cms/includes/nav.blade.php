<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#cms-nav" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="{{ url('cms') }}"><img src="{{ asset('img/logo_hero_128x128.png') }}" /></a>
	</div>
	<ul class="nav navbar-right top-nav">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a href="{{ url() }}"><i class="fa fa-globe"></i> Main Site</a></li>
				<li><a href="{{ url('auth/logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
			</ul>
		</li>
	</ul>
	<div class="navbar-collapse collapse" aria-expanded="false" id="cms-nav">
		<ul class="nav navbar-nav side-nav">
			<li class="">
				<a href="{{ url('cms') }}">
					<i class="fa fa-fw fa-tachometer"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<li class="">
				<a href="{{ url('cms/heroes') }}">
					<i class="fa fa-fw fa-hero">&nbsp;</i>
					<span>Heroes</span>
				</a>
			</li>
			<li class="">
				<a href="{{ url('cms/shop') }}">
					<i class="fa fa-fw fa-shopping-cart"></i>
					<span>Shop</span>
				</a>
				<ul>
					<li class="">
						<a href="{{ url('cms/shop/orders') }}">
							<i class="fa fa-fw fa-gift"></i>
							<span>Orders</span>
						</a>
					</li>
					<li class="">
						<a href="{{ url('cms/shop/products') }}">
							<i class="fa fa-fw fa-male"></i>
							<span>Products</span>
						</a>
					</li>
					<li class="">
						<a href="{{ url('cms/shop/attributes') }}">
							<i class="fa fa-fw fa-filter"></i>
							<span>Attributes</span>
						</a>
					</li>
					<li class="">
						<a href="{{ url('cms/shop/categories') }}">
							<i class="fa fa-fw fa-copy"></i>
							<span>Categories</span>
						</a>
					</li>
					<li class="">
						<a href="{{ url('cms/shop/tags') }}">
							<i class="fa fa-fw fa-tags"></i>
							<span>Tags</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="">
				<a href="{{ url('cms/users') }}">
					<i class="fa fa-fw fa-users"></i>
					<span>Users</span>
				</a>
			</li>
			<li class="">
				<a href="{{ url('cms/emails') }}">
					<i class="fa fa-fw fa-envelope"></i>
					<span>Emails</span>
				</a>
			</li>
			<li class="">
				<a href="{{ url('cms/pages') }}">
					<i class="fa fa-fw fa-pencil-square"></i>
					<span>CMS</span>
				</a>
				<ul>
					<li class="">
						<a href="{{ url('cms/pages') }}">
							<i class="fa fa-fw fa-file-o"></i>
							<span>Pages</span>
						</a>
					</li>
					<li class="">
						<a href="{{ url('cms/partials') }}">
							<i class="fa fa-fw fa-file-code-o"></i>
							<span>Partials</span>
						</a>
					</li>
					<li class="">
						<a href="{{ url('cms/layouts') }}">
							<i class="fa fa-fw fa-file-text-o"></i>
							<span>Layouts</span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>
