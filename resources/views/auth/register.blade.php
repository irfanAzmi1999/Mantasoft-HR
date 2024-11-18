<!DOCTYPE html>
<html>
<head>
	<title>{{ __('Register') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href={{ asset('img/LogoVNatas.png') }} rel="shortcut icon"/>
	{{-- <link href={{ asset('css/css-login/style.css') }} rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <div>{{ __('Register') }}</div>
                    <div>
                        <form action={{ route('register') }} method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="col-md-4 col-form-label ">{{ __('Full name') }}</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name" placeholder="Full name" autocomplete="name" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="department_id" class="col-md-4 col-form-label ">{{ __('Department') }}</label>
                                    <select class="form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required autofocus>
                                        <option value="" disabled="disabled" selected="selected">Select department...</option>
                                        @foreach ($department as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="role_id" class="col-md-4 col-form-label ">{{ __('Role') }}</label>
                                    <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required autofocus>
                                        <option value="" disabled="disabled" selected="selected">Select role...</option>
                                        @foreach ($role as $r)
                                            <option value="{{ $r->id }}">{{ $r->display_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="superior_id" class="col-md-4 col-form-label ">{{ __('Superior') }}</label>
                                    <select class="form-control @error('superior_id') is-invalid @enderror" id="superior_id" name="superior_id" required autofocus>
                                        <option value="" disabled="disabled" selected="selected">Select superior...</option>
                                        @foreach ($superior as $s)
                                            <option value="{{ $s->user_id }}">{{ $s->getUser->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('superior_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="col-md-4 col-form-label ">{{ __('Username') }}</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" id="username" name="username" placeholder="Username" autocomplete="username" required autofocus>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="col-md-4 col-form-label ">{{ __('Password') }}</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label ">{{ __('Retype password') }}</label>
                                    <input type="password" class="form-control @error('password-confirm') is-invalid @enderror" id="password-confirm" name="password_confirmation" autocomplete="new-password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="col-md-4 col-form-label ">{{ __('Email') }}</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="Email" autocomplete="email" required autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="col-md-4 col-form-label ">{{ __('Phone number') }}</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" id="phone" name="phone" placeholder="Phone number" autocomplete="phone" required autofocus>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="employ_date" class="col-md-4 col-form-label ">{{ __('Employment date') }}</label>
                                    <input type="date" class="form-control @error('employ_date') is-invalid @enderror" value="{{ old('employ_date') }}" id="employ_date" name="employ_date" autocomplete="employ_date" required autofocus>
                                    @error('employ_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="company_id" class="col-md-4 col-form-label ">{{ __('Company') }}</label>
                                    <select class="form-control @error('company_id') is-invalid @enderror" id="company_id" name="company_id" required autofocus>
                                        <option value="" disabled="disabled" selected="selected">Select company...</option>
                                        @foreach ($company as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>