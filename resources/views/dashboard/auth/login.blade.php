<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/') }}/css/main.css">


    <script src="{{ asset('admin/') }}/js/jquery-3.3.1.min.js"></script>



    <!-- noty -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/noty/noty.css')}}">
    <script src="{{ asset('admin/plugins/noty/noty.min.js')}}"></script>



    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - Vali Admin</title>
  </head>
  <body>


    @include('dashboard.includes._sessions')



    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Vali</h1>
      </div>
      <div class="login-box">

        <form class="login-form" action="{{route('dashboard.dologin')}}" method="post">
            @csrf
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i> Login </h3>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input class="form-control" name="email" id="email" type="text" required placeholder="Email " autofocus>
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input class="form-control" type="password" name="password" id="password" required placeholder="Password">
            @error("password")
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <input  name="remember_me" id="remember-me" type="checkbox"><span class="label-text"> Remember me</span>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip"> Lost password?</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i>
                Login
            </button>
         </div>
        </form>
        <form class="forget-form" action="index.html">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i> هل نسيت كلمه المرور ؟</h3>
          <div class="form-group">
            <label class="control-label">البريد الالكتروني</label>
            <input class="form-control" type="text" placeholder="البريد">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>اعاده تعيين</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i>  العوده الي تسجيل الدخول</a></p>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('admin') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('admin') }}/js/popper.min.js"></script>
    <script src="{{ asset('admin') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin') }}/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('admin') }}/js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });



    </script>
  </body>
</html>
