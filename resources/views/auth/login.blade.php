<!DOCTYPE html>
<html lang="en">
<head>
	@include('layout.partials._assets', ['title' => 'Login'])
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h3 class="page-header text-center">
					Login
				</h3>
				{!! Form::open(['method' => 'POST', 'url' => url('/login'), 'class' => 'form']) !!}
					<div class="form-group">
						{!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'E-mail Address']) !!}
					</div>
					<div class="form-group">
						{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
					</div>
					<div class="form-group">
						<button type="submit" class="btn-md btn btn-block btn-primary">
							Login
						</button>
					</div>
					@include('layout.partials._errors')
					<div class="form-group">
						<a href="{{ url('/register') }}">Create an account</a>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</body>
</html>