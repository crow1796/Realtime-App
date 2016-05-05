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
					<li role="presentation" class="dropdown" class="notifications-dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Notifications
						</a>
						<ul class="dropdown-menu">
							<li role="presentation">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi quae, blanditiis vitae facilis, magni voluptas odio cum iste, natus ipsum labore asperiores? Illo illum repellat, facere deleniti maxime architecto sint!
							</li>
						</ul>
					</li>
					<li role="presentation">
						<a href="{{ url('/logout') }}">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>