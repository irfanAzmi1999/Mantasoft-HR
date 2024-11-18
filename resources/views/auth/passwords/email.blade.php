<!DOCTYPE html>
<html>
<head>
	<title>{{ __('Reset Password') }} | VN Human Resource - VN Leave v2</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../img/LogoVNatas.png" rel="shortcut icon"/>
	<link rel="stylesheet" type="text/css" href="../css/css-login/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<img class="wave" src="../img/orange-curve.png">
	<div class="container">
		<div class="img">
			<img src="../img/undraw_forgot_password_re_hxwm (1).svg">
		</div>
		<div class="login-content">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
			<form method="post" action="{{ route('password.email') }}">
				@csrf
				<h2 class="title">{{ __('Reset Password') }}</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-envelope"></i>
           		   </div>
           		   <div class="div">
                        <h5 for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</h5>
           		   		<input type="email" class="input form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
           		   </div>
           		</div>
				@error('email')
				   <span class="invalid-feedback red"  role="alert">
					   <strong>{{ $message }}</strong>
				   </span>
			   @enderror
           		<div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/login/main.js"></script>
</body>
</html>
