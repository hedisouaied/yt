<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Login Page</title>
	<link rel="stylesheet" href="{{asset('backend/assets/styles/style.min.css')}}">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="{{asset('backend/assets/plugin/waves/waves.min.css')}}">

</head>

<body>

<div id="single-wrapper">
	<form method="POST" action="{{ route('login') }}"class="frm-single">
        @csrf
		<div class="inside">
			<div class="title"><strong>Admin</strong></div>
			<!-- /.title -->
			<div class="frm-title">Login</div>
			<!-- /.frm-title -->
			<div class="frm-input">
                <input type="text" placeholder="Email" class="frm-inp" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus><i class="fa fa-user frm-ico"></i>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
			<!-- /.frm-input -->
			<div class="frm-input">
                <input type="password" placeholder="Password" class="frm-inp" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <i class="fa fa-lock frm-ico"></i>
                @error('password')
                <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
                </span>
                 @enderror
            </div>
			<!-- /.frm-input -->


			<button type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>

		</div>
		<!-- .inside -->
	</form>
	<!-- /.frm-single -->
</div>
</body>
</html>
