<!DOCTYPE html>
<html>
<head>
	<title>{{ __('Login') }} | VN Leave by VN Human Resource</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="{{ asset('img/LogoVNatas.png') }}" rel="shortcut icon" />
	<link href="{{ asset('css/css-login/style.css') }}" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<img class="wave" src="{{ asset('img/orange-curve.png') }}" />
	<div class="container">
		<div class="img">
			<img src="{{ asset('img/secure_login.svg') }}" />
		</div>
		<div class="login-content">
			<form method="post" action="{{ route('login') }}">
				@csrf
				<h2 class="title">{{ __('Login') }}</h2>
				{{--
				<div class="input-div one">
					<div class="i"><i class="fas fa-envelope"></i></div>
					<div class="div">
						<h5 for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</h5>
						<input type="email" class="input form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
					</div>
				</div>
				@error('email')
				<span class="invalid-feedback" role="alert" style="color: red;">
					<strong>{{ $message }}</strong>
				</span>
				@enderror --}}
				<div class="input-div one">
					<div class="i"><i class="fas fa-user"></i></div>
					<div class="div">
						<h5 for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</h5>
						<input type="text" class="input form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username') }}" autocomplete="username" autofocus />
					</div>
				</div>
				@error('username')
				<span class="invalid-feedback" role="alert" style="color: red;">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<h5 for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</h5>
						<input type="password" class="input form-control @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="current-password" />
					</div>
				</div>
				@error('password')
				<span class="invalid-feedback" role="alert" style="color: red;">
					<strong>{{ $message }}</strong>
				</span>
				@enderror @if (Route::has('password.request'))
				<a href="{{ route('password.request') }}">
					{{ __('Forgot Your Password?') }}
				</a>
				@endif
				<div class="row mb-0">
					<div class="col-md-8 offset-md-4">
						<button type="submit" class="btn btn-primary">
							{{ __('Login') }}
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="js/login/main.js"></script>
</body>
</html>