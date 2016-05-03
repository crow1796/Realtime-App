<!DOCTYPE html>
<html lang="en">
<head>
	@include('layout.partials._assets', ['title' => 'Register'])
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h3 class="page-header text-center">
					Register
				</h3>
				{!! Form::open(['method' => 'POST', 'url' => url('/register'), 'class' => 'form']) !!}
					<div class="form-group">
						{!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
					</div>
					<div class="form-group">
						{!! Form::text('middle_name', old('middle_name'), ['class' => 'form-control', 'placeholder' => 'Middle Name']) !!}
					</div>
					<div class="form-group">
						{!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
					</div>
					<div class="form-group">
						{!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'E-mail Address']) !!}
					</div>
					<div class="form-group">
						{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
					</div>
					<div class="form-group">
						{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
					</div>
					<div class="form-group">
						<button type="submit" class="btn-md btn btn-block btn-primary">
							Register
						</button>
					</div>
					@include('layout.partials._errors')
					<div class="form-group">
						<a href="{{ url('/login') }}">Click here to login</a>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</body>
</html>