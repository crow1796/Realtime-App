<header>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar" type="button">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a href="{{ url('/') }}" class="navbar-brand">
					RT APP
				</a>
			</div>

			<div class="collapse navbar-collapse" id="main-navbar">
				<ul class="nav navbar-nav pull-right">
					<li role="presentation">
						<a href="{{ url('/') }}">Home</a>
					</li>
					<li role="presentation">
						<a href="{{ url('/friends') }}">Friends</a>
					</li>
					<li role="presentation">
						<a href="#">Notifications</a>
					</li>
					<li role="presentation">
						<a href="{{ url('/logout') }}">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>