<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/login.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

	<title>Document</title>
</head>
<body>
	<div class="row">
		<div class="col-9 left-side">
			<img class="logo" src="images/logo.png" alt="">

			<div class="title pl-5 pr-5 pt-3 pb-3">
				<h1>Bubble my Tea</h1>
				<p>Start your day with a bubble Tea 🧋</p>
			</div>

		</div>
		<div class="col-3 right-side">
			<div class="float-right p-3">
				<a class="btn btn-outline-primary sign-up-btn pl-5 pr-5" href="login">Sign in</a>
			</div>
			<div class="mt-5 pt-5">
				<p class="welcome-text">Become a member ! 🎉</p>
			</div>

			<form action="{{ route('auth.register')}}" method="POST">
				@csrf
				<div class="container box-input">
					<label for="email">Name</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon3">
								<i class="icon ion-md-person"></i>
							</span>
						</div>
						<input type="text" class="form-control custom-input" id="email" aria-describedby="basic-addon3" name="name" required>
					</div>
				</div>
	
	
				<div class="container box-input">
					<label for="email">Email Address</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon3">
								<i class="icon ion-md-mail"></i>
							</span>
						</div>
						<input type="email" class="form-control custom-input" id="email" aria-describedby="basic-addon3" name="email" required>
					</div>
				</div>
	
				<div class="container box-input">
					<label for="basic-url">Password</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon3">
								<i class="icon ion-md-finger-print"></i>
							</span>
						</div>
						<input type="password" class="form-control custom-input" id="basic-url" aria-describedby="basic-addon3" name="password" required>
					</div>
				</div>
	
				<div class="container box-input">
					<label for="basic-url">Confirm your Password</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon3">
								<i class="icon ion-md-finger-print"></i>
							</span>
						</div>
						<input type="password" class="form-control custom-input" id="basic-url" aria-describedby="basic-addon3" required>
					</div>
				</div>
	
				<div class="box-input text-right">
					<button class="btn btn-link forgotPassword">Forgot Password ?</button>
				</div>
	
				<div class="container box-input mt-5">
					<input type="submit" class="btn btn-primary main-btn w-100" value="Login">
				</div>
			</form>

		</div>
	</div>
</body>
</html>