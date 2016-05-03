<!DOCTYPE html>
<html lang="en" ng-app="rt_app">
<head>
	@include('layout.partials._assets', ['title' => $title])
</head>
<body>
	@include('layout.partials._header')
	<div class="container">
		@yield('content')
	</div>
	@include('layout.partials._footer')
</body>
</html>