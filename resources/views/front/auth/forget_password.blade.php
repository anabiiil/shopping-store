@extends('layouts.site')
@section('content')



<section id="form" style="margin-top:20px;"><!--form-->
	<div class="container">
		<div class="row">

			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Forgot Password?</h2>
					<form id="forgotPasswordForm" name="forgotPasswordForm" action="{{ route('forgetPassword') }}" method="POST">
                        @csrf
						<input name="email" type="email" placeholder="Email Address" required="" />
						<button type="submit" class="btn btn-default">Submit</button><br>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">OR</h2>
			</div>
			<div class="col-sm-4">
				<div class="signup-form"><!--sign up form-->
					<h2>New User Signup!</h2>
					<form id="registerForm" name="registerForm" action="{{ url('/user-register') }}" method="POST">{{ csrf_field() }}
						<input id="name" name="name" type="text" placeholder="Name"/>
						<input id="email" name="email" type="email" placeholder="Email Address"/>
						<input id="myPassword" name="password" type="password" placeholder="Password"/>
						<button type="submit" class="btn btn-default">Signup</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->

@endsection
