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
					<li role="presentation" class="dropdown notifications-dropdown" ng-controller="notificationsController as notificationsVm">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span class="fa fa-bell notification-icon @{{ notificationsVm.showClass ? hit-bell : '' }}">
								<span class="notification-count" ng-bind="notificationsVm.notifications.length"></span>
							</span>
						</a>
						<ul class="dropdown-menu">
							<li role="presentation" ng-repeat="notification in notificationsVm.notifications">
								<span ng-bind="notification.message"></span>
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