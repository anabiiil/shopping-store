<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
    <link href="{{ asset('front/') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('front/') }}/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('front/') }}/css/prettyPhoto.css" rel="stylesheet">
    <link href="{{ asset('front/') }}/css/price-range.css" rel="stylesheet">
    <link href="{{ asset('front/') }}/css/animate.css" rel="stylesheet">
	<link href="{{ asset('front/') }}/css/main.css" rel="stylesheet">
	<link href="{{ asset('front/') }}/css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('front/css/passtrength.css') }}">


    <!-- noty -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/noty/noty.css')}}">
    <script src="{{ asset('admin/plugins/noty/noty.min.js')}}"></script>

    <link rel="shortcut icon" href="{{ asset('front/') }}/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('front/') }}/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('front/') }}/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('front/') }}/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('front/') }}/images/ico/apple-touch-icon-57-precomposed.png">
    <style>
        .input-icons i {
            position: absolute;
        }

        .input-icons {
            width: 100%;
            margin-bottom: 10px;
        }

        .icon {
            padding: 10px;
            color: #999;
            min-width: 50px;
            text-align: center;
            right: 7px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
         }


        .text-success {
    color: #28a745;
}
.text-danger {
    color: #dc3545;
}
    </style>
</head><!--/head-->

<body>

    @include('front.includes._header')
    @include('front.includes._sessions')


	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login</h2>
                        <form class="login-form" id="loginForm" name="loginForm"  action="{{route('front.dologin')}}" method="post">
                            @csrf
							<input type="email" name="email" placeholder="Enter Your Email" />
							<input type="password" name="password" placeholder="Enter Your Password" />
							<button type="submit" class="btn btn-default">Login</button><br>
                            <a href="{{ url('forget-password') }}">Forget Password ?</a>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Register New Account</h2>
						<form id="registerForm" class="form" name="registerForm" action="{{ route('front.register') }}" method="post">
                            @csrf

                            <input type="hidden" name="address">
                            <input type="hidden" name="city">
                            <input type="hidden" name="country">
                            <input type="hidden" name="mobile">
                            <input type="hidden" name="phonecode">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Name" id="name"  class="form-control input-sm" required>
                                 </div>
                                @error("name")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                     <input type="email" name="email"placeholder="Enter Email" id="email"  class="form-control input-sm" required>
                                 </div>
                                @error("email")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-sm-12 input-icons">
                                <div class="form-group">
                                    <input type="password" id="myPassword" name="password" data-src="pass"  placeholder="Enter Password" class="form-control input-field input-sm" required/>
                                </div>
                                @error("password")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-sm-12 input-icons">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Register </button>
                                </div>

                            </div>

						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


    @include('front.includes._footer')
    <script src="{{ asset('front/') }}/js/jquery.js"></script>
	<script src="{{ asset('front/') }}/js/price-range.js"></script>
    <script src="{{ asset('front/') }}/js/jquery.scrollUp.min.js"></script>
	<script src="{{ asset('front/') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('front/') }}/js/jquery.prettyPhoto.js"></script>
    <script src="{{ asset('front/') }}/js/main.js"></script>
    <script src="{{ asset('front/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('front/js/passtrength.js') }}"></script>
    <script>


    $().ready(function(){

	// Validate Register form on keyup and submit
	$("#registerForm").validate({
		rules:{
			name:{
				required:true,
				minlength:3,
                regx: /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/			},
			password:{
				required:true,
				minlength:6
			},

			email:{
				required:true,
				email:true,
				remote:"/check-email"
			}
		},
		messages:{
			name:{
				required:"من فضلك ادخل Name",
 				minlength: "Name يجب ان يحتوي علي ثلاثه احرف علي الاقل",
                regx: "<font color='red'>enter only english or arabic letters</font>"			},
			password:{
				required:"من فضلك ادخل كلمه المرور",
 				minlength: "كلمه المرور يجب ان تحتوي علي 6 ارقام علي الاقل",
 			},
			email:{
				required: "من فضلك ادخل البريد الالكتروني",
				email: "من فضلك ادخل بريد الكتروني صحيح",
				remote: "هذا البريد مستخدم من قبل!"
			}
		}
	});



	// Validate Login form on keyup and submit
	$("#loginForm").validate({
		rules:{
			email:{
				required:true,
				email:true
			},
			password:{
				required:true
			}
		},
		messages:{

            password:{
				required:"من فضلك ادخل كلمه المرور",
  			},
			email:{
				required: "من فضلك ادخل البريد الالكتروني",
				email: "من فضلك ادخل بريد الكتروني صحيح",
 			}
		}
	});




	// Password Strength Script
	$('#myPassword').passtrength({
      minChars: 6,
      passwordToggle: true,
      tooltip: true,
      textWeak: "Weak",
      textMedium: "Medium",
      textStrong: "Strong",
      textVeryStrong: "Very Strong",
      eyeImg : "/front/images/eye.svg"
    });




});

    </script>
</body>
</html>
